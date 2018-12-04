### Commands ran during the course of this implementation  

##### Create The project
`$ composer create-project symfony/skeleton symfart`  

##### On a different console terminal run PHP inbuilt server
`$ php -S 127.0.1.1:9000 -t public`  

##### For a better server run  
`$ composer require server`  
`$ php bin/console server:run`  or `bin/console server:run`  
    
##### Bring in Annotation package for routing  
`$ composer require annotations`  
  
##### Bring in Twig package for template engine  
`$ composer require twig`  
  
##### Bring in Doctrine ORM  
`$ composer require doctrine maker`  
  
##### Create a database after modifying the DATABASE_URL config in .env  
`$ php bin/console doctrine:database:create`    
  
##### Create an entity  called Article  
`$ php bin/console make:entity Article`  
  
##### Generating a Schema  
`$  php bin/console doctrine:migrations:diff`     
  
##### Run generated migration  
`$ php bin/console doctrine:migrations:migrate` 
  
To alter a table, you modify the Entity representing the table (src/Entity/Article.php) and then run the diff and migrate command again i.e re-regenerate the  schema (`$  php bin/console doctrine:migrations:diff` )
and re-run the migration (`$ php bin/console doctrine:migrations:migrate` ) .  
  
##### Run SQL query on terminal using doctrine  
`$ php bin/console doctrine:query:sql 'select * from article'`  

##### Bring in the form builder  
`$ composer require form`
`



