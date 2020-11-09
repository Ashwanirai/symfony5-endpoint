# symfony5-endpoint

composer install

Connection String : 
DATABASE_URL=mysql://root:@127.0.0.1:3306/devon?serverVersion=10.4.13-MariaDB

Databse Name : devon

php bin/console doctrine:schema:update --force

https://127.0.0.1:8000/api/device?filter[d.model]=Dell R210Intel Xeon X3440&filter[d.ram]=16GBDDR3&filter[d.hdd_value]=4&filter[d.hdd_unit]=TB&filter[d.hdd_type]=SATA&filter[d.model_location]=AmsterdamAMS-01&limit=100
