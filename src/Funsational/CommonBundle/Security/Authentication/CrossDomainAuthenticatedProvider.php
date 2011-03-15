<?php

namespace Funsational\CommonBundle\Security\Authentication;

use Symfony\Component\EventDispatcher\EventInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Symfony\Component\HttpKernel\Log\LoggerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class CrossDomainAuthenticatedProvider implements AuthenticationProviderInterface
{	
    /**
     * {@inheritdoc}
     */
    public function authenticate(TokenInterface $token)
    {
        var_dump('test');
    	return;
    	
    	if (!$this->supports($token)) {
            return null;
        }

        $username = null === $token->getUser() ? 'NONE_PROVIDED' : (string) $token;

        try {
            $user = $this->retrieveUser($username, $token);

            if (!$user instanceof AccountInterface) {
                throw new AuthenticationServiceException('retrieveUser() must return an AccountInterface.');
            }

            $this->accountChecker->checkPreAuth($user);
            $this->checkAuthentication($user, $token);
            $this->accountChecker->checkPostAuth($user);

            $authenticatedToken = new UsernamePasswordToken($user, $token->getCredentials(), $this->providerKey, $user->getRoles());
            $authenticatedToken->setAttributes($token->getAttributes());

            return $authenticatedToken;
        } catch (UsernameNotFoundException $notFound) {
            if ($this->hideUserNotFoundExceptions) {
                throw new BadCredentialsException('Bad credentials', 0, $notFound);
            }

            throw $notFound;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function supports(TokenInterface $token)
    {
        return $token instanceof UsernamePasswordToken && $this->providerKey === $token->getProviderKey();
    }
}