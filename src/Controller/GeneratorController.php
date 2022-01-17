<?php

namespace App\Controller;

use App\Service\Names;
use App\Service\SimpleCharacter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/generator/', name: 'app_generator_')]
class GeneratorController extends AbstractController
{
    #[Route('simple-character', name: 'simple_character')]
    public function simpleCharacter(SimpleCharacter $character): Response
    {
        $dir = dirname(__DIR__) . '/GeneratorFiles/simpleCharacter';

        $filesystem = new Filesystem();

        // Ensure that the simpleCharacter folders exist
        if ($filesystem->exists([
                $dir . '/about',
                $dir . '/body',
                $dir . '/tribe',
            ]) === false) {
            throw new Exception('Something went wrong! Does the text file exist?');
        }

        $directoryFinder = new Finder();
        $directoryFinder->directories()->ignoreUnreadableDirs()->in($dir);

        $fileFinder = new Finder();
        $fileFinder->files()->ignoreUnreadableDirs();

        $generatorFiles = [];
        // For each directory inside `simpleCharacter` locate all the files and
        // push them into an array
        foreach ($directoryFinder as $directory) {
            $fileFinder = new Finder();
            $fileFinder->files()->ignoreUnreadableDirs();
            $fileFinder->in($dir . '/' . $directory->getBasename());

            foreach ($fileFinder as $file) {
                $fileName = $file->getRelativePathname();
                $filePath = $file->getRealPath();
                $generatorFiles[$directory->getBasename()][$fileName] = $filePath;
            }
        }

        $characterData = $character->build($generatorFiles);

        return $this->render('generator/simple_character.html.twig', [
            'controller_name' => 'GeneratorController',

            'character' => $characterData,
        ]);
    }

    #[Route('names/{tribe}', name: 'names')]
    public function names(Names $names, $tribe): Response
    {
        $filesystem = new Filesystem();

        $dir = dirname(__DIR__) . '/GeneratorFiles/names';

        if ($filesystem->exists($dir . '/' . $tribe . '.txt') === false) {
            throw $this->createNotFoundException();
        }

        if ($tribe === 'nightwings') {
            $tribeHasSplitNames = true;
        } else {
            $tribeHasSplitNames = false;
        }

        $nameList = $names->generate($dir . '/' . $tribe, $tribeHasSplitNames, 10);

        return $this->render('generator/names.html.twig', [
            'controller_name' => 'GeneratorController',

            'tribe' => $tribe,
            'names' => $nameList,
        ]);
    }
}
