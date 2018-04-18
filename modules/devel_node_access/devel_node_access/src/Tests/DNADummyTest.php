<?php

namespace Drupal\devel_node_access\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Provides a dummy test so that the testbot can run and check whether proposed patches can be applied.
 *
 * @group devel_node_access
 */
class DNADummyTest extends WebTestBase {

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
  }

  /**
   * Tests success (to allow the testbot to run).
   */
  public function testDNASuccess()  {
    $this->assertTrue(TRUE);
  }

}
