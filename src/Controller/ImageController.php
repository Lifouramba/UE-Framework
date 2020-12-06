<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImageController extends AbstractController
{
    /**
     * @Route("/img/home", name="home")
     */
    public function home(): Response
    {
        return $this->render('img/home.html.twig');
    }

    /**
     * @Route("/img/data/{name}", name="home")
     */
    public function visite($photo):Response
    {
        $img = "images/".$_FILES['image']['photo'];
        $t=0;
        while(file_exists($img)){
            $img = "images/".$_FILES['image']['photo'];
            $img=substr($img,0,strpos($img,"."))."_$t".strstr($img,".");
            $t++;}
            move_uploaded_file($_FILES['photo']['images'], $img);
    }

}
