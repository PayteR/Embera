<?php
/**
 * TestCollegeHumor.php
 *
 * @package Tests
 * @author Michael Pratt <pratt@hablarmierda.net>
 * @link   http://www.michael-pratt.com/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class TestCollegeHumor extends PHPUnit_Framework_TestCase
{

    protected $validUrls, $invalidUrls;

    public function setUp()
    {
        $this->validUrls   = UrlList::get('CollegeHumor');
        $this->invalidUrls = UrlList::get('CollegeHumor', true);
    }

    public function testInvalidUrl()
    {
        $this->setExpectedException('InvalidArgumentException');

        $oembed = new MockOembed(new MockHttpRequest());
        new \Embera\Providers\CollegeHumor($this->invalidUrls[mt_rand(0, (count($this->invalidUrls) - 1))], array(), $oembed);
    }

    public function testRealResponse()
    {
        $oembed = new \Embera\Oembed(new \Embera\HttpRequest());
        $url = $this->validUrls[mt_rand(0, (count($this->validUrls) - 1))];
        $test = new \Embera\Providers\CollegeHumor($url, array('oembed' => true), $oembed);
        $result = $test->getInfo();

        $this->assertTrue($result['embera_using_fake'] == 0, 'Using fake on ' . $url);

        $url = $this->validUrls[mt_rand(0, (count($this->validUrls) - 1))];
        $test = new \Embera\Providers\CollegeHumor($url, array('oembed' => true), $oembed);
        $result = $test->getInfo();

        $this->assertTrue($result['embera_using_fake'] == 0, 'Using fake on ' . $url);

        $url = $this->validUrls[mt_rand(0, (count($this->validUrls) - 1))];
        $test = new \Embera\Providers\CollegeHumor($url, array('oembed' => true), $oembed);
        $result = $test->getInfo();

        $this->assertTrue($result['embera_using_fake'] == 0, 'Using fake on ' . $url);
    }
}

?>
