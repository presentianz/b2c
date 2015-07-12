<?php

/* base.html.twig */
class __TwigTemplate_e6d57578770a3f69c2e5d470730d4c511d3067087c9e9598ac4e74a0ddda9db4 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_89623574bb1a395110bc3851d6009b10762c72653bc5a624338854261bdc2588 = $this->env->getExtension("native_profiler");
        $__internal_89623574bb1a395110bc3851d6009b10762c72653bc5a624338854261bdc2588->enter($__internal_89623574bb1a395110bc3851d6009b10762c72653bc5a624338854261bdc2588_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "base.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        ";
        // line 6
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 7
        echo "        <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
    </head>
    <body>
        ";
        // line 10
        $this->displayBlock('body', $context, $blocks);
        // line 11
        echo "        ";
        $this->displayBlock('javascripts', $context, $blocks);
        // line 12
        echo "    </body>
</html>
";
        
        $__internal_89623574bb1a395110bc3851d6009b10762c72653bc5a624338854261bdc2588->leave($__internal_89623574bb1a395110bc3851d6009b10762c72653bc5a624338854261bdc2588_prof);

    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        $__internal_411bd677513841b7ed7bbd7f2b410e3eb4e16bf073fdf6a7935f2f5c9ffa91fa = $this->env->getExtension("native_profiler");
        $__internal_411bd677513841b7ed7bbd7f2b410e3eb4e16bf073fdf6a7935f2f5c9ffa91fa->enter($__internal_411bd677513841b7ed7bbd7f2b410e3eb4e16bf073fdf6a7935f2f5c9ffa91fa_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "Welcome!";
        
        $__internal_411bd677513841b7ed7bbd7f2b410e3eb4e16bf073fdf6a7935f2f5c9ffa91fa->leave($__internal_411bd677513841b7ed7bbd7f2b410e3eb4e16bf073fdf6a7935f2f5c9ffa91fa_prof);

    }

    // line 6
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_9521332367fc24806a60fcff68df6942825428b5d434873bffc7bbd467057972 = $this->env->getExtension("native_profiler");
        $__internal_9521332367fc24806a60fcff68df6942825428b5d434873bffc7bbd467057972->enter($__internal_9521332367fc24806a60fcff68df6942825428b5d434873bffc7bbd467057972_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        
        $__internal_9521332367fc24806a60fcff68df6942825428b5d434873bffc7bbd467057972->leave($__internal_9521332367fc24806a60fcff68df6942825428b5d434873bffc7bbd467057972_prof);

    }

    // line 10
    public function block_body($context, array $blocks = array())
    {
        $__internal_e08948e44df473dc37b3914d10d5ca4885176406f8bc05bebb99edb147684d16 = $this->env->getExtension("native_profiler");
        $__internal_e08948e44df473dc37b3914d10d5ca4885176406f8bc05bebb99edb147684d16->enter($__internal_e08948e44df473dc37b3914d10d5ca4885176406f8bc05bebb99edb147684d16_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        
        $__internal_e08948e44df473dc37b3914d10d5ca4885176406f8bc05bebb99edb147684d16->leave($__internal_e08948e44df473dc37b3914d10d5ca4885176406f8bc05bebb99edb147684d16_prof);

    }

    // line 11
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_006647e4bbbf58afc6cddad56227f69246e894eecc45021f06277536159d2d42 = $this->env->getExtension("native_profiler");
        $__internal_006647e4bbbf58afc6cddad56227f69246e894eecc45021f06277536159d2d42->enter($__internal_006647e4bbbf58afc6cddad56227f69246e894eecc45021f06277536159d2d42_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        
        $__internal_006647e4bbbf58afc6cddad56227f69246e894eecc45021f06277536159d2d42->leave($__internal_006647e4bbbf58afc6cddad56227f69246e894eecc45021f06277536159d2d42_prof);

    }

    public function getTemplateName()
    {
        return "base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  93 => 11,  82 => 10,  71 => 6,  59 => 5,  50 => 12,  47 => 11,  45 => 10,  38 => 7,  36 => 6,  32 => 5,  26 => 1,);
    }
}
