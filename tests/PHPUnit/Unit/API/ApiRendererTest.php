<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link https://matomo.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Tests\Unit\API;

use Piwik\API\ApiRenderer;
use Piwik\Plugin\Manager;

/**
 * @group Core
 * @group Only2
 */
class ApiRendererTest extends \PHPUnit\Framework\TestCase
{
    public function setUp(): void
    {
        Manager::getInstance()->loadPlugins(array('API'));
    }

    public function test_factory_shouldCreateAnInstance_IfValidFormatGiven()
    {
        $renderer = ApiRenderer::factory('php', array());
        $this->assertInstanceOf('Piwik\Plugins\API\Renderer\Php', $renderer);

        $renderer = ApiRenderer::factory('PHP', array());
        $this->assertInstanceOf('Piwik\Plugins\API\Renderer\Php', $renderer);

        $renderer = ApiRenderer::factory('pHp', array());
        $this->assertInstanceOf('Piwik\Plugins\API\Renderer\Php', $renderer);

        $renderer = ApiRenderer::factory('xmL', array());
        $this->assertInstanceOf('Piwik\Plugins\API\Renderer\Xml', $renderer);

        $renderer = ApiRenderer::factory('OriginAl', array());
        $this->assertInstanceOf('Piwik\Plugins\API\Renderer\Original', $renderer);
    }

    public function test_factory_shouldThrowAnException_IfInvalidFormatGiven()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('General_ExceptionInvalidRendererFormat');

        ApiRenderer::factory('phpi', array());
    }
}
