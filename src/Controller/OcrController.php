<?php

namespace App\Controller;

use App\Entity\Ocr;
use App\Form\OcrType;
use App\Repository\OcrRepository;
use App\Utils\OcrBusiness;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

/**
 * Class OcrController
 * @package App\Controller
 *
 * @Route("/ocr")
 */
class OcrController extends Controller
{
    /**
     * @param OcrRepository $ocrRepository
     * @return Response
     *
     * @Route("/", name="ocr_index", methods="GET")
     */
    public function index(OcrRepository $ocrRepository): Response
    {
        return $this->render('ocr/index.html.twig', ['ocrs' => $ocrRepository->findAll()]);
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @Route("/upload", name="ocr_upload", methods="GET|POST")
     */
    public function upload(Request $request): Response
    {
        $ocr = new Ocr();
        $form = $this->createForm(OcrType::class, $ocr);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                try {
                    $ocrBusiness = new OcrBusiness($ocr->getImageFile()->getPathname(),
                        $ocr->getImageFile()->getMimeType());
                    $ocr->setContent($ocrBusiness->extractText());
                } catch (\Exception $e) {
                    $this->addFlash('danger', $e->getMessage());
                    return $this->redirectToRoute('ocr_upload');
                }

                $em = $this->getDoctrine()->getManager();
                $em->persist($ocr);
                $em->flush();
                $this->addFlash('success', 'message_upload_success');
                return $this->redirectToRoute('ocr_show', ['id' => $ocr->getId()]);
            } else {
                $this->addFlash('danger', 'message_upload_danger');
            }
        }

        return $this->render('ocr/upload.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @param Ocr $ocr
     * @param UploaderHelper $helper
     * @return Response
     *
     * @Route("/{id}", name="ocr_show", methods="GET")
     */
    public function show(Ocr $ocr, UploaderHelper $helper): Response
    {
        return $this->render('ocr/show.html.twig', [
            'ocr' => $ocr,
            'img_path' => $helper->asset($ocr, 'imageFile'),
        ]);
    }

    /**
     * @param Request $request
     * @param Ocr $ocr
     * @param UploaderHelper $helper
     * @return Response
     *
     * @Route("/{id}/edit", name="ocr_edit", methods="GET|POST")
     *
     * @Security("user.getId() == ocr.getOwner().getId()")
     */
    public function edit(Request $request, Ocr $ocr, UploaderHelper $helper): Response
    {
        $form = $this->createForm(OcrType::class, $ocr);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                try {
                    $ocrBusiness = new OcrBusiness($ocr->getImageFile()->getPathname(),
                        $ocr->getImageFile()->getMimeType());
                    $ocr->setContent($ocrBusiness->extractText());
                } catch (\Exception $e) {
                    $this->addFlash('danger', $e->getMessage());
                    return $this->redirectToRoute('ocr_edit', ['id' => $ocr->getId()]);
                }

                $this->getDoctrine()->getManager()->flush();
                $this->addFlash('success', 'message_upload_success');
                return $this->redirectToRoute('ocr_edit', ['id' => $ocr->getId()]);
            } else {
                $this->addFlash('danger', 'message_upload_danger');
            }
        }

        $imgPath = ($helper->asset($ocr, 'imageFile')) ?? null;
        return $this->render('ocr/edit.html.twig', [
            'ocr' => $ocr,
            'form' => $form->createView(),
            'img_path' => $imgPath,
        ]);
    }

    /**
     * @param Request $request
     * @param Ocr $ocr
     * @return Response
     *
     * @Route("/{id}", name="ocr_delete", methods="DELETE")
     *
     * @Security("user.getId() == ocr.getOwner().getId()")
     */
    public function delete(Request $request, Ocr $ocr): Response
    {
        if ($this->isCsrfTokenValid('delete' . $ocr->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ocr);
            $em->flush();
        }

        return $this->redirectToRoute('ocr_index');
    }
}
