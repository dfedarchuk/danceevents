<?php

namespace ArcaSolutions\ApiBundle\Security;


use ArcaSolutions\CoreBundle\Kernel\Kernel;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class ApiKeyUserProvider implements UserProviderInterface
{
    /**
     * @var string
     */
    protected $environment;

    /**
     * @var array
     */
    protected $tokens;

    /**
     * @var array
     */
    protected $pin;

    /**
     * ApiKeyUserProvider constructor.
     *
     * @param KernelInterface $kernel
     * @param array $tokens
     * @param array $pin
     */
    public function __construct(KernelInterface $kernel, $tokens, $pin)
    {
        $this->environment = $kernel->getEnvironment();
        $this->tokens = $tokens;
        $this->pin = $pin;
    }

    public function getDomainForApiKey($apiKey)
    {
        $aproved = false;

        $token = array_search($apiKey, $this->tokens);
        $preview = array_search($apiKey, $this->pin);

        if ((($token or $preview) and Kernel::ENV_DEV !== $this->environment) or Kernel::ENV_DEV == $this->environment) {
            $aproved = true;
        }

        return $aproved;
    }

    /**
     * Loads the user for the given username.
     *
     * This method must throw UsernameNotFoundException if the user is not
     * found.
     *
     * @param string $username The username
     *
     * @return UserInterface
     *
     * @throws UsernameNotFoundException if the user is not found
     */
    public function loadUserByUsername($username)
    {
        return new User($username, null, ['ROLE_API']);
    }

    /**
     * Refreshes the user for the account interface.
     *
     * It is up to the implementation to decide if the user data should be
     * totally reloaded (e.g. from the database), or if the UserInterface
     * object can just be merged into some internal array of users / identity
     * map.
     *
     * @param UserInterface $user
     *
     * @return UserInterface
     *
     * @throws UnsupportedUserException if the account is not supported
     */
    public function refreshUser(UserInterface $user)
    {
        /**
         * This is used for storing authentication in the session
         * but in this example, the token is sent in each request,
         * so authentication can be stateless. Throwing this exception
         * is proper to make things stateless
         */
        throw new UnsupportedUserException();
    }

    /**
     * Whether this provider supports the given user class.
     *
     * @param string $class
     *
     * @return bool
     */
    public function supportsClass($class)
    {
        return 'Symfony\Component\Security\Core\User\User' === $class;
    }
}
