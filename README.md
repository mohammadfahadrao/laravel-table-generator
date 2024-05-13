# Table & Migration Generator
Package to Create Database Table from anywhere by supplying key value pairs. Saves time from running migration command and specifying columns in migration file for tables with loads of columns.

### Installation
To deploy this package run
```bash
  composer require mohammadfahadrao/mfr-tokens
```

In your Controller/Trait or anywhere in Laravel Project use it:

    
    use Mohammadfahadrao\MfrTokens\MfrToken;




    $mfr = new MfrToken();
    $mfr->generateMigration(["name"=>'mfr',"age"=>21, ["categories"=>["name"=>"xyz","type"=>1]]]);
    
    
This'll create a new Migration file with those columns with prefix `mfr_tokens`. After making desired changes just migrate it
```bash
    php artisan migrate
```

Additional improvements are being done. Till then Enjoy!
