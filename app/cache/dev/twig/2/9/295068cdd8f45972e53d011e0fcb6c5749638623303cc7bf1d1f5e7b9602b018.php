<?php

/* TwigBundle:Exception:exception_full.html.twig */
class __TwigTemplate_295068cdd8f45972e53d011e0fcb6c5749638623303cc7bf1d1f5e7b9602b018 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("TwigBundle::layout.html.twig", "TwigBundle:Exception:exception_full.html.twig", 1);
        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "TwigBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_1157e9cc0b2efa97c4a1dce55b74bf78b15b8c022b8a5b95a94ec6a80a0df005 = $this->env->getExtension("native_profiler");
        $__internal_1157e9cc0b2efa97c4a1dce55b74bf78b15b8c022b8a5b95a94ec6a80a0df005->enter($__internal_1157e9cc0b2efa97c4a1dce55b74bf78b15b8c022b8a5b95a94ec6a80a0df005_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "TwigBundle:Exception:exception_full.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_1157e9cc0b2efa97c4a1dce55b74bf78b15b8c022b8a5b95a94ec6a80a0df005->leave($__internal_1157e9cc0b2efa97c4a1dce55b74bf78b15b8c022b8a5b95a94ec6a80a0df005_prof);

    }

    // line 3
    public function block_head($context, array $blocks = array())
    {
        $__internal_551c5590d761c0b34816871f9e3d9b80d1f1d2eed836943b701ff80b5c954757 = $this->env->getExtension("native_profiler");
        $__internal_551c5590d761c0b34816871f9e3d9b80d1f1d2eed836943b701ff80b5c954757->enter($__internal_551c5590d761c0b34816871f9e3d9b80d1f1d2eed836943b701ff80b5c954757_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head"));

        // line 4
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("bundles/framework/css/exception.css")), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
";
        
        $__internal_551c5590d761c0b34816871f9e3d9b80d1f1d2eed836943b701ff80b5c954757->leave($__internal_551c5590d761c0b34816871f9e3d9b80d1f1d2eed836943b701ff80b5c954757_prof);

    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
        $__internal_c97dd9dc43eed14eaf2b716f2c782e409a225ae5d161c6ec179c90243f0f7f71 = $this->env->getExtension("native_profiler");
        $__internal_c97dd9dc43eed14eaf2b716f2c782e409a225ae5d161c6ec179c90243f0f7f71->enter($__internal_c97dd9dc43eed14eaf2b716f2c782e409a225ae5d161c6ec179c90243f0f7f71_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        // line 8
        echo "    ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")), "message", array()), "html", null, true);
        echo " (";
        echo twig_escape_filter($this->env, (isset($context["status_code"]) ? $context["status_code"] : $this->getContext($context, "status_code")), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["status_text"]) ? $context["status_text"] : $this->getContext($context, "status_text")), "html", null, true);
        echo ")
";
        
        $__internal_c97dd9dc43eed14eaf2b716f2c782e409a225ae5d161c6ec179c90243f0f7f71->leave($__internal_c97dd9dc43eed14eaf2b716f2c782e409a225ae5d161c6ec179c90243f0f7f71_prof);

    }

    // line 11
    public function block_body($context, array $blocks = array())
    {
        $__internal_5140d44fb9c10ea5930568303c4b051a2e2a29cdd59cbdf60a988a912f37cbbc = $this->env->getExtension("native_profiler");
        $__internal_5140d44fb9c10ea5930568303c4b051a2e2a29cdd59cbdf60a988a912f37cbbc->enter($__internal_5140d44fb9c10ea5930568303c4b051a2e2a29cdd59cbdf60a988a912f37cbbc_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 12
        echo "    ";
        $this->loadTemplate("TwigBundle:Exception:exception.html.twig", "TwigBundle:Exception:exception_full.html.twig", 12)->display($context);
        
        $__internal_5140d44fb9c10ea5930568303c4b051a2e2a29cdd59cbdf60a988a912f37cbbc->leave($__internal_5140d44fb9c10ea5930568303c4b051a2e2a29cdd59cbdf60a988a912f37cbbc_prof);

    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:exception_full.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 12,  72 => 11,  58 => 8,  52 => 7,  42 => 4,  36 => 3,  11 => 1,);
    }
}
