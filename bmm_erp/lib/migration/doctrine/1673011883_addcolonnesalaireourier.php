<?php

class Addcolonnesalaireourier extends Doctrine_Migration_Base
{
    public function up()
    {

        $this->addColumn('Historiquecontratouvrier', 'paye', 'boolean');
        $this->addColumn('salaireouvrier', 'datedebut', 'date');
        $this->addColumn('salaireouvrier', 'datefin', 'date');
        $this->addColumn('salaireouvrier', 'title', 'character varying');
        $this->addColumn('salaireouvrier', 'jourferier', 'integer');


    }

    public function down()
    {
    }
}
