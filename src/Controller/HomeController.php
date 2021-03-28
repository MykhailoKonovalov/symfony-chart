<?php

namespace App\Controller;

use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     * @param ProductsRepository $productsRepository
     * @param ChartBuilderInterface $chartBuilder
     * @return Response
     */
    public function index(ProductsRepository $productsRepository, ChartBuilderInterface $chartBuilder): Response
    {
          $labels = [];
        $datasets = [];
        $products = $productsRepository->findAll();
        foreach($products as $data){
            $labels[] = $data->getId();
            $datasets[] = $data->getQuantity();
        }
        $chart = $chartBuilder->createChart(Chart::TYPE_DOUGHNUT);
        $chart->setData([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'My First dataset',
                    'backgroundColor' => 'rgb(75, 192, 192)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => $datasets,
                ],
            ],
        ]);

        $chart->setOptions([]);

        return $this->render('home/index.html.twig', [
            'chart' => $chart,
        ]);
    }
}
