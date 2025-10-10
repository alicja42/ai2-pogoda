<?php

namespace App\Controller;

use App\Entity\Location;
use App\Repository\MeasurementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\LocationRepository;


final class WeatherController extends AbstractController
{
//    #[Route('/weather/{id}', name: 'app_weather', requirements: ['id'=>'\d+'])]
//    public function city(Location $location, MeasurementRepository $repository): Response
//    {
//        $measurements = $repository->findByLocation($location);
//
//        return $this->render('weather/city.html.twig', [
//            'location' => $location,
//            'measurements' => $measurements,
//        ]);
//    }

    #[Route('/weather/{city}/{country?}', name: 'app_weather')]
    public function city(
        string $city,
        ?string $country,
        LocationRepository $locationRepository,
        MeasurementRepository $measurementRepository
    ): Response
    {
        $location = $locationRepository->findByCity($city, $country);

        if (!$location) {
            throw $this->createNotFoundException('Location not found');
        }

        $measurements = $measurementRepository->findByLocation($location);

        return $this->render('weather/city.html.twig', [
            'location' => $location,
            'measurements' => $measurements,
        ]);
    }
}
