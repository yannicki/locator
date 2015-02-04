<?php
namespace CCM\LocatorBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class LocatorCommand extends ContainerAwareCommand
{

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setDefinition(array(
            new InputArgument('query', InputArgument::REQUIRED, 'Any string you want')
        ))
            ->setName('ccm:locator')
            ->setDescription('Get all location by query.')
            ->setHelp(<<<EOF
The <info>%command.name%</info> gets all location.
EOF
            )
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //$result = $this->getContainer()->get('ccm_locator.google_place')->searchByKeyword($input->getArgument('query'));

        $results = $this->getContainer()->get('ccm_locator.chained_locator')->searchByKeyword($input->getArgument('query'));

        foreach ($results as $result) {
            $output->writeln('<info>'.$result['name'].'</info>');
            $output->writeln($result['adress']);
            $output->writeln('<comment>Found by</comment> '.$result['source']);
            $output->writeln('-------------------');
        }

        //$output->writeln($result);
        //var_dump($results);
    }

}