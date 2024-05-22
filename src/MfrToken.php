<?php

namespace Mohammadfahadrao\MfrTokens;
use Mohammadfahadrao\MfrTokens\Traits\MigrationManager;

class MfrToken
{
   use MigrationManager;

    

    public function generateMigration(array $responseData)
    {
        $migrationContent = $this->generateMigrationContent($responseData);
        $migrationFileName = $this->writeMigrationFile($migrationContent);
        return $migrationFileName;
    }
}