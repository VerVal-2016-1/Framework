# Ignitest

Ignitest is a test Framework for CodeIgniter 2.2.x. If your application uses CodeIgniter as the base Framework, you'll wanna try Iginitest to literally ignite your tests, since CodeIgniter test class does not offer many resources.

Ignitest is convention oriented, just tell us the name of your test class and will load it for you!

Ignitest uses PHPUnit and DBUnit (PHPUnit extension) to make the tests, so you need them both to use Ignitest. Info on how to get these is easily found in [PHPUnit manual](https://phpunit.de/manual). Ignitest is a elegant way to connect PHPUnit and CodeIgniter together with some few extra bonus.

Ignitest currently covers unit and integration tests. Unit tests are understood as test of domain classes that you may create during development and Integration tests are understood as your controller-model conversation tests (that may involve the database for testing).

Currently, Ignitest is working only with MySQL for tests that use the database.

## Installation

* After you have installed PHPUnit and DBUnit, download Ignitest from this repository;

* Copy the **ignitest** folder to your CodeIgniter project on **application/tests** directory;

* Go to ignitest directory;

		cd application/tests/ignitest

* Set the configurations files with **ignitest init**
		
		php ignitest.php init

## Configuring

Once you have initiated Ignitest, it will create a configuration file named **config_ignitest.php** on your **application/tests** directory. In this configuration file you must set:

* **Path Settings constants**

	* **APPPATH** - This is the CodeIgniter application folder path. If your **config_ignitest.php** file is under **application/tests/**, just leave it as it is. Otherwise, change it to match your application folder.

	* **CONTROLLERPATH** - The default value for this constant is the CodeIgniter controllers folder path. This is where Ignitest will look for your controllers to make integrations tests. If your controllers are placed in another location, set your controllers path here.

	* **DOMAINPATH** - The default value for this constant is a folder named "domain" under CodeIgniter application folder. You probably won't have this folder in your directory structure, so set this constant to a folder where your domain classes will reside.

* **Database Settings constants**

  As Ignitest is only supporting MySQL in the moment, this constants purpose is to configure your test database. Set the following:

	* **HOST** - Your test database host name. If you are using a local test database, use "localhost".

	* **USERNAME** - Your MySQL username.

	* **PASSWORD** - Your MySQL password.

	* **DATABASE_NAME** - Your test database name.

	* **DATASET** - Your dataset path. By default, Ignitest uses PHPUnit MySQLXML as dataset, which is a XML file that says what must be the test database state before each test. If you don't wanna use PHPUnit MySQLXML Dataset, you'll need to override the getDataSet() method on your integration test cases. Check the availables options of dataset in [PHPUnit Manual](https://phpunit.de/manual/current/en/database.html#database.understanding-datasets-and-datatables).

## Usage instructions

With Ignitest, after you have configurated it, you can create unit and integration test classes, implement your tests and then run them.

* **Unit test**

	* Create a unit test class based on a domain class name. Ignitest will try to find the class you've informed on your *DOMAINPATH* and then create the test class for it by adding the sufix 'Test' on the name of your domain. The tests will be placed under the folder **application/tests/unit_tests**.

			php ignitest.php create_unit <class name>

			or

			php ignitest.php -ut <class name>

	* Run your unit tests

			php ignitest.php run units

* **Integration test**

	* Create a integration test based on a controller class name. Ignitest will try to find the class you've informed on your *CONTROLLERPATH* and then create test class for it by adding the sufix 'Test' on the name of your controller. The tests will be placed under the folder **application/tests/integration_tests**.

			php ignitest.php create_integration <class name>

			or

			php ignitest.php -it <class name>

	* ***OBS.:*** Remember to create your dataset and set the path to it on DATASET constant. You can create your MySQLXML dataset with **mysqldump** tool:

			mysqldump --xml -t -u <your_mysql_user> --password=<your_mysql_password> <your_test_database> > <path_to_dataset.xml>
			
	* ***Tip***.: Once you are in your integration test class, an instance of your controller under test is available through the attribute $this->testClass.

	* Run your integration tests

			php ignitest.php run integrations

* You can run all your tests too:
	
		php ignitest.php run all

* Any doubt that arrises, you could use the Ignitest help to see available commands:
	
		php ignitest.php help

		or

		php ignitest.php -h

## For possible contributors: Ignitest Technical Structure

On the inside of Ignitest, it uses the Command Pattern to deal with command line commands, which each command is modeled as an object and in addition has it own metadata to describe it. Each command is treated and added in the queue to be executed.
