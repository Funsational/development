<?php
namespace Funsational\CommonBundle\Entity\Session;

/**
 * Session
 *
 * @Table(name="sessions", indexes={
 *  @index(name="last_activity", columns={"last_activity"})
 * })
 */
class Session
{
    /**
     * @var string $id
     *
     * @Column(name="id", type="string", length=32, nullable=false)
     * @Id
     */
    private $id;

    /**
     * @var string $ipAddress
     *
     * @Column(name="ip_address", type="string", length=40, nullable=false)
     */
    private $ipAddress;

    /**
     * @var integer $start
     *
     * @Column(name="start", type="integer", nullable=false)
     */
    private $start;

    /**
     * @var integer $lastActivity
     *
     * @Column(name="last_activity", type="integer", nullable=false)
     */
    private $lastActivity;

    /**
     * @var integer $lastSync
     *
     * @Column(name="last_sync", type="integer", nullable=true)
     */
    private $lastSync;

    /**
     * @var string $browser
     *
     * @Column(name="browser", type="string", length=255, nullable=false)
     */
    private $browser;

    /**
     * @var string $page
     *
     * @Column(name="page", type="string", length=255, nullable=false)
     */
    private $page;

    /**
     * @var text $extra
     *
     * @Column(name="extra", type="text", nullable=false)
     */
    private $extra;

    public function getExtra() {
        return $this->extra;
    }

    public function setCustomer($customer) {
        $this->Customer = $customer;
    }

    public function getCustomer() {
        return $this->Customer;
    }

    /**
     * Generate a new session ID
     *
     * @param string $extra
     */
    private function generateNewSid($extra = '')
    {
        while (strlen($this->id) < 32)
        {
            $this->id .= mt_rand(0, mt_getrandmax());
        }

        // Add extra data to SID, usually the users IP
        $this->id .= $extra;

        // Now hash
        return md5(uniqid($this->id, true));
    }

    /**
     * @return the $id
     */
    function getId() {
        return $this->id;
    }

    /**
     * @return the $ipAddress
     */
    function getIpAddress() {
        return $this->ipAddress;
    }

    /**
     * @return the $start
     */
    function getStart() {
        return $this->start;
    }

    /**
     * @return the $lastActivity
     */
    function getLastActivity() {
        return $this->lastActivity;
    }

    /**
     * @return the $lastSync
     */
    function getLastSync() {
        return $this->lastSync;
    }

    /**
     * @return the $browser
     */
    function getBrowser() {
        return $this->browser;
    }

    /**
     * @return the $page
     */
    function getPage() {
        return $this->page;
    }

    function setId($sid) {
        $this->id = $sid;
    }

    /**
     * @param $ipAddress the $ipAddress to set
     */
    function setIpAddress($ipAddress) {
        $this->ipAddress = $ipAddress;
    }

    /**
     * @param $start the $start to set
     */
    function setStart($start) {
        $this->start = $start;
    }

    /**
     * @param $lastActivity the $lastActivity to set
     */
    function setLastActivity($lastActivity) {
        $this->lastActivity = $lastActivity;
    }

    /**
     * @param $lastSync the $lastSync to set
     */
    function setLastSync($lastSync) {
        $this->lastSync = $lastSync;
    }

    /**
     * @param $browser the $browser to set
     */
    function setBrowser($browser) {
        $this->browser = $browser;
    }

    /**
     * @param $page the $page to set
     */
    function setPage($page) {
        $this->page = $page;
    }
}