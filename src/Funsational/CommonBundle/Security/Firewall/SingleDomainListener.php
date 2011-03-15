<?php
namespace Funsational\CommonBundle\Security\Firewall;

use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;use Symfony\Component\Security\Http\Firewall\ListenerInterface;
use Symfony\Component\HttpKernel\Log\LoggerInterface;
use Symfony\Component\Security\Http\Firewall\AbstractPreAuthenticatedListener;
use Symfony\Component\EventDispatcher\EventInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class SingleDomainListener implements ListenerInterface
{
	protected $securityContext;
    protected $authenticationManager;
    protected $providerKey;
    protected $logger;
    
	public function __construct(SecurityContextInterface $securityContext, AuthenticationManagerInterface $authenticationManager, $providerKey, LoggerInterface $logger = null)
    {
		$this->securityContext = $securityContext;
        $this->authenticationManager = $authenticationManager;
        $this->providerKey = $providerKey;
        $this->logger = $logger;
	}
	
    /**
     *
     *
     * @param EventDispatcherInterface $dispatcher An EventDispatcherInterface instance
     * @param integer                  $priority   The priority
     */
    public function register(EventDispatcherInterface $dispatcher)
    {
        $dispatcher->connect('core.security', array($this, 'handle'), 0);
    }

    /**
     * {@inheritDoc}
     */
    public function unregister(EventDispatcherInterface $dispatcher)
    {
    }

    /**
     * Handles channel management.
     *
     * @param EventInterface $event An EventInterface instance
     */
    public function handle(EventInterface $event)
    {
        $request = $event->get('request');
//var_dump($event);
        $token = $this->securityContext->getToken();

        $session = $request->getSession();
        
        $session->set('last_sync', time());
        
//        bool setcookie ( string $name [, string $value [, int $expire = 0 [, string $path [, string $domain [, bool $secure = false [, bool $httponly = false ]]]]]] )
//        var_dump($session);
//        var_dump($session->getStorage());
//        $response->headers->setCookie(
//            new Cookie(
//                $this->options['name'],
//                $value,
//                $expires,
//                $this->options['path'],
//                $this->options['domain'],
//                $this->options['secure'],
//                $this->options['httponly']
//            )
//        );
        
//        if ($this->requiresTransfer()) {
//
//        } else if ($this->requiresSync()) {
//        	
//        }
//        var_dump($token);;
        
//        list($attributes, $channel) = $this->map->getPatterns($request);
//
//        if ('https' === $channel && !$request->isSecure()) {
//            if (null !== $this->logger) {
//                $this->logger->debug('Redirecting to HTTPS');
//            }
//
//            $event->setProcessed();
//
//            return $this->authenticationEntryPoint->start($event, $request);
//        }
//
//        if ('http' === $channel && $request->isSecure()) {
//            if (null !== $this->logger) {
//                $this->logger->debug('Redirecting to HTTP');
//            }
//
//            $event->setProcessed();
//
//            return $this->authenticationEntryPoint->start($event, $request);
//        }
    }
}