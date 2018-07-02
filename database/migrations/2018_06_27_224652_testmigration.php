    <?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Testmigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('customerNumber');
            $table->string('customerName', 50);
            $table->string('contactLastName', 50);
            $table->string('contactFirstName', 50);
            $table->string('phone', 50);
            $table->string('addressLine1', 50);
            $table->string('addressLine2', 50);
            $table->string('city', 50);
            $table->string('state', 50);
            $table->string('postalCode', 15);
            $table->string('country', 50);
            $table->integer('salesRepEmployeeNumber');
            $table->decimal('creditLimit', 10, 2);
            
        });
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('employeeNumber');
            $table->string('lastName', 50);
            $table->string('firstName', 50);
            $table->string('extension', 10);
            $table->string('email', 100);
            $table->string('officeCode', 10);
            $table->integer('reportsTo');
            $table->string('jobTitle', 50);
        });
        Schema::create('offices', function (Blueprint $table) {
            $table->string('officeCode', 10);
            $table->string('city', 50);
            $table->string('phone', 50);
            $table->string('addressLine1', 50);
            $table->string('addressLine2', 50);
            $table->string('state', 50);
            $table->string('country', 50);
            $table->string('postalCode', 15);
            $table->string('territory', 10);
        });
        Schema::create('orderdetails', function (Blueprint $table) {
            $table->increments('orderNumber');
            $table->string('productCode');
            $table->integer('quantityOrdered');
            $table->decimal('priceEach', 10, 2);
            $table->smallInteger('orderLineNumber');
        });
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('orderNumber');
            $table->date('orderDate');
            $table->date('requiredDate');
            $table->date('shippedDate');
            $table->string('status');
            $table->text('comments');
            $table->integer('customerNumber');
        });
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('customerNumber');
            $table->string('checkNumber', 50);
            $table->date('paymentDate');
            $table->decimal('amount', 10, 2);
        });
        Schema::create('productlines', function (Blueprint $table) {
            $table->string('productLine', 50);
            $table->string('textDescription', 4000)->nullable();
            $table->mediumText('htmlDescription')->nullable();
            $table->binary('image')->nullable();
        });
        Schema::create('products', function (Blueprint $table) {
            $table->string('productCode', 15);
            $table->string('productName', 70);
            $table->string('productLine', 50);
            $table->string('productScale', 10);
            $table->string('productVendor', 50);
            $table->text('productDescription');
            $table->smallInteger('quantityInStock');
            $table->decimal('buyPrice', 10, 2);
            $table->decimal('MSRP', 10, 2);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('customers');
        Schema::drop('employees');
        Schema::drop('offices');
        Schema::drop('orderdetails');
        Schema::drop('orders');
        Schema::drop('payments');
        Schema::drop('productlines');
        Schema::drop('products');
    }
}
