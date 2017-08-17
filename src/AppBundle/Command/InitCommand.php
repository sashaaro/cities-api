<?php

namespace AppBundle\Command;

use OAuth2\OAuth2;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class InitCommand
 */
class InitCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('app:init');
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