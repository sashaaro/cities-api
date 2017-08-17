<?php

namespace AppBundle\Command;

use OAuth2\OAuth2;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CreateOauth2ClientCommand
 */
class CreateOauth2ClientCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('app:oauth2:create-client');
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $clientManager = $this->getContainer()->get('fos_oauth_server.client_manager.default');
        $client = $clientManager->createClient();
        $client->setAllowedGrantTypes([OAuth2::GRANT_TYPE_IMPLICIT, OAuth2::GRANT_TYPE_USER_CREDENTIALS]);
        $clientManager->updateClient($client);

        $output->writeln(sprintf("OAuth client was successfully added. Public id: \"%s\". Secret \"%s\"" , $client->getPublicId(), $client->getSecret()));
    }
}