<?php

namespace SoftCode\GridBundle\Builder;

use SoftCode\GridBundle\DataSource\DataSourceInterface;
use Symfony\Bundle\TwigBundle\TwigEngine;
use Symfony\Bundle\FrameworkBundle\Translation\Translator;
use SoftCode\GridBundle\Grid;

/**
 *
 * GridBuilder is a way how to create grid without need of passing Translator and TwigEngine
 * in each construct call.
 * @author Martin Hlaváč
 *
 */
class GridBuilder
{
    /**
     * @var Symfony\Bundle\FrameworkBundle\Translation\Translator
     */
    private $translator;

    /**
     * @var Symfony\Bundle\TwigBundle\TwigEngine $templating
     */
    private $templating;

    /**
     * @param Symfony\Bundle\FrameworkBundle\Translation\Translator
     * @param Symfony\Bundle\TwigBundle\TwigEngine $templating
     */
    public function __construct(Translator $translator, TwigEngine $templating)
    {
        $this->translator = $translator;
        $this->templating = $templating;
    }

    /**
     * @param SoftCode\GridBundle\DataSource\DataSourceInterface $dataSource
     * @param Symfony\Bundle\FrameworkBundle\Translation\Translator
     * @param \Twig_Template $templating
     * @return SoftCode\GridBundle\Grid
     */
    public function build(DataSourceInterface $dataSource, Translator $translator = null, TwigEngine $templating = null)
    {
        $translator = $translator ?: $this->translator;
        $templating = $templating ?: $this->templating;

        return new Grid($dataSource, $translator, $templating);
    }
}
