<?php

/* @WebProfiler/Collector/ajax.html.twig */
class __TwigTemplate_0d5a35611426f6b9cbea2a9892a70f160bd579fe8edd3ed29c27da13f7a8a19f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@WebProfiler/Profiler/layout.html.twig", "@WebProfiler/Collector/ajax.html.twig", 1);
        $this->blocks = array(
            'toolbar' => array($this, 'block_toolbar'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@WebProfiler/Profiler/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_7f9ef8e842e8160ca4e770ca9db1cecb30e5b8dd8ed1a7fd31c8e62cf3bd12aa = $this->env->getExtension("native_profiler");
        $__internal_7f9ef8e842e8160ca4e770ca9db1cecb30e5b8dd8ed1a7fd31c8e62cf3bd12aa->enter($__internal_7f9ef8e842e8160ca4e770ca9db1cecb30e5b8dd8ed1a7fd31c8e62cf3bd12aa_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@WebProfiler/Collector/ajax.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_7f9ef8e842e8160ca4e770ca9db1cecb30e5b8dd8ed1a7fd31c8e62cf3bd12aa->leave($__internal_7f9ef8e842e8160ca4e770ca9db1cecb30e5b8dd8ed1a7fd31c8e62cf3bd12aa_prof);

    }

    // line 3
    public function block_toolbar($context, array $blocks = array())
    {
        $__internal_4ea08dfaa7bf0f39bf2d392890e54199131da545199c80c84a4f53ec431de2e7 = $this->env->getExtension("native_profiler");
        $__internal_4ea08dfaa7bf0f39bf2d392890e54199131da545199c80c84a4f53ec431de2e7->enter($__internal_4ea08dfaa7bf0f39bf2d392890e54199131da545199c80c84a4f53ec431de2e7_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "toolbar"));

        // line 4
        echo "    ";
        $context["icon"] = ('' === $tmp = "        <span>
            <svg width=\"24\" height=\"28\" xmlns=\"http://www.w3.org/2000/svg\" version=\"1.1\" x=\"0px\" y=\"0px\" viewBox=\"0 0 24 28\" enable-background=\"new 0 0 24 28\" xml:space=\"preserve\"><polygon fill=\"#3F3F3F\" points=\"18.4,3.8 12.8,9.4 16.3,9.4 16.3,21.1 14.1,21.1 9.9,25.3 16.3,25.3 20.5,25.3 20.5,21.1 20.5,9.4 23.9,9.4\"/><polygon fill=\"#3F3F3F\" points=\"5.6,25.3 11.2,19.7 7.7,19.7 7.7,8 9.9,8 14.1,3.8 7.7,3.8 3.5,3.8 3.5,8 3.5,19.7 0.1,19.7\"/></svg>
            <span class=\"sf-toolbar-ajax-requests\">0</span>
        </span>
    ") ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 10
        echo "    ";
        $context["text"] = ('' === $tmp = "        <div class=\"sf-toolbar-info-piece\">
            <b>AJAX requests</b>
            <span class=\"sf-toolbar-ajax-info\"></span>
        </div>
        <div class=\"sf-toolbar-info-piece\">
            <table class=\"sf-toolbar-ajax-requests\">
                <thead>
                    <tr>
                        <th>Method</th>
                        <th>URL</th>
                        <th>Time</th>
                        <th>Profile</th>
                    </tr>
                </thead>
                <tbody class=\"sf-toolbar-ajax-request-list\"></tbody>
            </table>
        </div>
    ") ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 29
        echo "    ";
        $this->loadTemplate("@WebProfiler/Profiler/toolbar_item.html.twig", "@WebProfiler/Collector/ajax.html.twig", 29)->display(array_merge($context, array("link" => false)));
        
        $__internal_4ea08dfaa7bf0f39bf2d392890e54199131da545199c80c84a4f53ec431de2e7->leave($__internal_4ea08dfaa7bf0f39bf2d392890e54199131da545199c80c84a4f53ec431de2e7_prof);

    }

    public function getTemplateName()
    {
        return "@WebProfiler/Collector/ajax.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  67 => 29,  47 => 10,  40 => 4,  34 => 3,  11 => 1,);
    }
}
