<?php

namespace App\Controller;


use App\Entity\Commande;
use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\CommandeRepository;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProduitController extends AbstractController
{


    /**
         * @Route("/afficherproduit",name="afficherproduit")
     */
    public function Affiche(ProduitRepository $repository){
        $tableprduits=$repository->findAll();
        return $this->render('produit/afficherProduits.html.twig'
            ,['tableproduits'=>$tableprduits]);

    }




    /**
     * @Route("/ajoutproduit",name="ajoutproduit")
     */
    public function ajouterProduit(EntityManagerInterface $em,Request $request ,ProduitRepository $UserRepository){
        $produit= new Produit();
        $form= $this->createForm(ProduitType::class,$produit);
        $form->add('Ajouter',SubmitType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $new=$form->getData();
            $imageFile = $form->get('imgproduit')->getData();
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename.'-'.uniqid().'.'.$imageFile->guessExtension();
                try {
                    $imageFile->move(
                        'back\images',
                        $newFilename
                    );
                } catch (FileException $e) {
                }
                $produit->setImgproduit($newFilename);
            }
            $em->persist($produit);
            $em->flush();


           return $this->redirectToRoute("afficherproduit");
        }
        return $this->render("produit/ajoutProduit.html.twig",array("form"=>$form->createView()));

    }


    /**
     * @Route("/supprimerproduit/{id}",name="supprimerproduit")
     */
    public function delete($id,EntityManagerInterface $em ,ProduitRepository $repository){
        $cours=$repository->find($id);
        $em->remove($cours);
        $em->flush();

        return $this->redirectToRoute('afficherproduit');
    }



    /**
     * @Route("/{id}/modifierproduit", name="modifierproduit", methods={"GET","POST"})
     */
    public function edit(Request $request, Produit $produit): Response
    {
        $form = $this->createForm(ProduitType::class, $produit);
        $form->add('Confirmer',SubmitType::class);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('imgproduit')->getData();
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename.'-'.uniqid().'.'.$imageFile->guessExtension();
                try {
                    $imageFile->move(
                        'back\images',
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $produit->setImgproduit($newFilename);
            }
            $this->getDoctrine()->getManager()->flush();


            return $this->redirectToRoute('afficherproduit');
        }

        return $this->render('produit/Modifierproduit.html.twig', [
            'produitmodif' => $produit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/affichercommande",name="affichercommande")
     */
    public function Affichercommande(CommandeRepository $repository){
        $tablecommandes=$repository->findAll();
        return $this->render('produit/afficherCommande.html.twig'
            ,['tablecommandes'=>$tablecommandes]);

    }


    /**
     * @Route("/afficherproduitClient",name="afficherproduitClient")
     */
    public function AfficheProduitClients(EntityManagerInterface $entityManager,Request $request,ProduitRepository $repository,CommandeRepository $commandeRepo){

        $produit = $repository->findOneBy(["id" => $request->get("id")]);

        $commande = new Commande($produit);
         $commande->setProduit($produit);

        $entityManager->persist($commande);
        $entityManager->flush();

        $tableprduits=$repository->findAll();
        return $this->render('produit/index.html.twig'
            ,['tableproduits'=>$tableprduits]);

    }

    /**
     * @Route("/suppcommande/{id}",name="suppcommande")
     */
    public function suppcommande($id,EntityManagerInterface $em ,CommandeRepository $repository){
        $cours=$repository->find($id);
        $em->remove($cours);
        $em->flush();

        return $this->redirectToRoute('affichercommande');
    }












  /*  /**
     * @Route("/afficherproduitClient",name="afficherproduitClient")
     */
   /* public function ajouterCommande(EntityManagerInterface $em,Request $request ,CommandeRepository $UserRepository,ProduitRepository $produitRepo){
        $tableprduits=$produitRepo->findAll();


        $commande= new Commande();
        $form= $this->createForm(Commande::class,$commande);
//////////
        $produit = $produitRepo->findOneBy(["id" => $request->get("id")]);


        $commande = new Commande();
        $commande->setCommande($produit);
        $em->persist($commande);
        $em->flush();

        $form->add('Acheter',SubmitType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $new=$form->getData();

            $em->persist($commande);
            $em->flush();


            return $this->redirectToRoute("afficherproduitClient");
       /* }
        return $this->render("produit/index.html.twig", [
          //  'commande' => $commande,
            'form'=>$form->createView(),
            //'tableproduits'=>$tableprduits

        ]);
    }*/






}
