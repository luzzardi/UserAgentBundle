<?php

namespace Wneto\UserAgentBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('wneto_user_agent');

        $rootNode->children()
            ->booleanNode('user_agent_validation')->isRequired()->defaultFalse()->end()
        ->end();

        $rootNode
            ->children()
                ->arrayNode('user_agent_patterns')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('pattern')->isRequired()->end()
                            ->booleanNode('allowed')->defaultFalse()->isRequired()->end()
                            ->scalarNode('version')->isRequired()->end()
                            ->scalarNode('operator')->isRequired()->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
