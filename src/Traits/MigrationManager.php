<?php

namespace Mohammadfahadrao\MfrTokens\Traits;

trait MigrationManager {

    /**
     * Create a migration file based on the response data.
     *
     * @param array $responseData The response data received from the API
     * @return string The name of the generated migration file
     */
    public function column_data_type($field_name, $field_value)
    {

        $dataType = getType($field_value);
        $DATA_TYPES = [
            'string' => "            \$table->string('$field_name');",
            'integer' => "            \$table->integer('$field_name');",
            'text' => "            \$table->text('$field_name');",
            'array' => "            \$table->json('$field_name');",
            'boolean' => "            \$table->boolean('$field_name');",
            'float' => "            \$table->float('$field_name');",
        ];
        if (array_key_exists($dataType, $DATA_TYPES)) {
            return $DATA_TYPES[$dataType];
        } else {
            return "            \$table->string('$field_name');";
        }
    }

    /**
     * Write the migration file.
     *
     * @param string $content The content of the migration file
     * @return string The name of the generated migration file
     */
    protected function writeMigrationFile(string $content)
    {
        $migrationFileName = 'mfr_tokens_' . date('Y_m_d_His') . '.php';
        $migrationFilePath = database_path('migrations/' . $migrationFileName);
        File::put($migrationFilePath, $content);
        return $migrationFileName;
    }

    /**
     * Generate the content of the migration file based on the response data.
     *
     * @param array $responseData The response data received from the API
     * @return string The content of the migration file
     */
    protected function generateMigrationContent(array $responseData)
    {
        $migrationContent = '<?php' . PHP_EOL . PHP_EOL;
        $migrationContent .= 'use Illuminate\Database\Migrations\Migration;' . PHP_EOL;
        $migrationContent .= 'use Illuminate\Database\Schema\Blueprint;' . PHP_EOL;
        $migrationContent .= 'use Illuminate\Support\Facades\Schema;' . PHP_EOL . PHP_EOL;
        $migrationContent .= 'return new class extends Migration' . PHP_EOL;
        $migrationContent .= '{' . PHP_EOL;
        $migrationContent .= '    public function up()' . PHP_EOL;
        $migrationContent .= '    {' . PHP_EOL;
        $migrationContent .= '        Schema::create(\'mfr_tokens\', function (Blueprint $table) {' . PHP_EOL;
        $migrationContent .= "            \$table->id();" . PHP_EOL;

        foreach ($responseData as $field => $type) {
            $migrationContent .= $this->column_data_type($field, $type) . PHP_EOL;
        }

        $migrationContent .= '            $table->timestamps();' . PHP_EOL;
        $migrationContent .= '        });' . PHP_EOL;
        $migrationContent .= '    }' . PHP_EOL;
        $migrationContent .= '    public function down()' . PHP_EOL;
        $migrationContent .= '    {' . PHP_EOL;
        $migrationContent .= '        Schema::dropIfExists(\'mfr_tokens\');' . PHP_EOL;
        $migrationContent .= '    }' . PHP_EOL;
        $migrationContent .= '};' . PHP_EOL;

        return $migrationContent;
    }
}