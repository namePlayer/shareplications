<?php

class TemplateEngine
{

    private array $alerts = [];

    public function render(string $name, array $arguments = [])
    {
        ob_start();

        extract($arguments);

        include(TEMPLATE_DIR . '/' . $name . '.php');

        return ob_get_clean();
    }

    public function addAlert($alertType, $alertMessage): void
    {
        $this->alerts[] = ['type' => $alertType, 'message' => $alertMessage];
    }

    public function outputAlerts(): string
    {
        $output = '';
        foreach ($this->alerts as $alert) {

            $output .= $this->render('alert', ['type' => $alert['type'], 'message' => $alert['message']]);

        }

        $this->alerts = [];

        return $output;
    }


}