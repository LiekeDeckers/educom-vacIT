<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;

class BaseController extends AbstractController
{
    private $logger;
    
    protected function log($msg) {
        $this->logger->info($msg);   
        //$this->logger->warning($msg);
        //$this->logger->error($msg);
    }
    
    public function __construct(LoggerInterface $logger) {
        $this->logger = $logger;
    } 
}
