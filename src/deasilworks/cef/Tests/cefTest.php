<?php

use deasilworks\cef\CEF;
use \deasilworks\cef\StatementBuilder\Select;
use \deasilworks\cef\Statement\Simple;

require_once (__DIR__ . '/src/TestEntityManager.php');

/**
 * Class cassandraTest
 */
class cefTest extends \PHPUnit_Framework_TestCase
{
    /**
     * CEF Test
     */
    public function testCEF()
    {
        $app = new \Silex\Application();
        $app->register(new CEF());

        $em = new TestEntityManager();
        $em->setConfig(array('keyspace' => 'system', 'contact_points' => array('127.0.0.1')));

        $sm = $em
            ->getStatementManager(Simple::class);

        /** @var \deasilworks\cef\StatementBuilder\Select $sb */
        $sb = $sm->getStatementBuilder(Select::class);

        // the default SELECT_JSON_TYPE is not available in cassandra 2.x
        $sm->setStatement($sb->setType(Select::SELECT_TYPE)->setFrom('local'));

        echo $sb->getStatement();

        /** @var \deasilworks\cef\ResultContainer $ec */
        $rc = $sm->execute();

        /** @var \deasilworks\cef\EntityModel $em */
        $em = $rc->current();

        // does it exist?
        $this->assertTrue(property_exists($em, 'cluster_name'));

        // is is not null?
        $this->assertTrue(isset($em->cluster_name));

    }

}