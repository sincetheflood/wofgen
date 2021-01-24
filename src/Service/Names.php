<?php


namespace App\Service;


class Names
{
    public function generate($tribeNameList, $hasSplitNames, $count): array
    {
        $allNames = $this->loadFile($tribeNameList . '.txt');
        shuffle($allNames);

        if ($hasSplitNames) {
            $splitNames = $this->buildSplitNames($tribeNameList);
            array_push($allNames, ...$splitNames);
            shuffle($allNames);
        }

        $namesIndices = array_rand($allNames, $count);

        $names = [];
        foreach ($namesIndices as $key => $value) {
            $names[] = $allNames[$value];
        }

        return $names;
    }

    /**
     * Read the contents of a generator file
     *
     * @param string $fileName
     * @return false|string[]
     */
    private function loadFile(string $fileName)
    {
        $fileContents = explode("\n", file_get_contents($fileName));
        shuffle($fileContents);

        return $fileContents;
    }

    private function buildSplitNames($tribeBaseName): array
    {
        $namePrefixes = $this->loadFile($tribeBaseName . '-prefix.txt');
        shuffle($namePrefixes);

        $nameSuffixes = $this->loadFile($tribeBaseName . '-suffix.txt');
        shuffle($nameSuffixes);

        $namesMerged = array_map('implode', array_map(null, $namePrefixes, $nameSuffixes));
        shuffle($namesMerged);

        return $namesMerged;
    }
}