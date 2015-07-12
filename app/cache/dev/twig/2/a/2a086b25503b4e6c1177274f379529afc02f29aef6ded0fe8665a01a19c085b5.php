<?php

/* default/index.html.twig */
class __TwigTemplate_2a086b25503b4e6c1177274f379529afc02f29aef6ded0fe8665a01a19c085b5 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.html.twig", "default/index.html.twig", 1);
        $this->blocks = array(
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_601f77d6094aed1f33f8e4c8ae21e8d1273f17c232fda5fc60d72615e2c84e36 = $this->env->getExtension("native_profiler");
        $__internal_601f77d6094aed1f33f8e4c8ae21e8d1273f17c232fda5fc60d72615e2c84e36->enter($__internal_601f77d6094aed1f33f8e4c8ae21e8d1273f17c232fda5fc60d72615e2c84e36_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "default/index.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_601f77d6094aed1f33f8e4c8ae21e8d1273f17c232fda5fc60d72615e2c84e36->leave($__internal_601f77d6094aed1f33f8e4c8ae21e8d1273f17c232fda5fc60d72615e2c84e36_prof);

    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        $__internal_8c91aff55abeabc6f306f13aa38270dd7612cd52ea1a7688313c6df1706794cb = $this->env->getExtension("native_profiler");
        $__internal_8c91aff55abeabc6f306f13aa38270dd7612cd52ea1a7688313c6df1706794cb->enter($__internal_8c91aff55abeabc6f306f13aa38270dd7612cd52ea1a7688313c6df1706794cb_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 4
        echo "    Homepage.
";
        
        $__internal_8c91aff55abeabc6f306f13aa38270dd7612cd52ea1a7688313c6df1706794cb->leave($__internal_8c91aff55abeabc6f306f13aa38270dd7612cd52ea1a7688313c6df1706794cb_prof);

    }

    public function getTemplateName()
    {
        return "default/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  40 => 4,  34 => 3,  11 => 1,);
    }
}
