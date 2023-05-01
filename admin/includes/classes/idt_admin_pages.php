<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly.

/**
 * Main admin pages class
 * @version 0.0.1
 */
class IdtAdminPages
{

	/**
     * Class construct
     */
	public function __construct()
    {
		$this->addAdminDashboard();
	}

	/**
     * Add the main admin dashboard
     * @return void
     */
	public function addAdminDashboard(): void
    {
        add_menu_page(
            __('Insomnio Dev Theme', 'insomniodev'),
            __('Insomnio Dev Theme', 'insomniodev'),
            'manage_options',
            'idt-dashboard',
            __CLASS__ . '::adminDashboardCallback',
            'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz48c3ZnIGlkPSJhIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA5MDkuNDEgODAwIj48ZGVmcz48c3R5bGU+LmJ7ZmlsbDojZmZmO308L3N0eWxlPjwvZGVmcz48cG9seWdvbiBjbGFzcz0iYiIgcG9pbnRzPSIyOTguMzQgMTgzLjkgMjk3Ljg3IDE4My41MyAyOTcuOTIgMTgzLjQ4IDI5OC4zNCAxODMuOSIvPjxwb2x5Z29uIGNsYXNzPSJiIiBwb2ludHM9IjYxMS41NCAxODMuNTEgNjExLjUxIDE4My41MyA2MTEuMjMgMTgzLjc1IDYxMS41MSAxODMuNDggNjExLjU0IDE4My41MSIvPjxwYXRoIGNsYXNzPSJiIiBkPSJNMjk3Ljg2LDE4My41M2wtNTIuMjIsNTIuMjItNTIuMjYsNTIuMjgtMjYuMDksMjYuMDlWMTI3LjIyYzAtMjcuNCwzMy4xNC00MS4xMyw1Mi41Mi0yMS43NWw3OC4wNSw3OC4wNloiLz48cGF0aCBjbGFzcz0iYiIgZD0iTTc0Mi4wNywxMjcuMjJ2MTg2Ljg1bC0yNi4wNC0yNi4wNC01Mi4yNi01Mi4yOC01Mi4yMy01Mi4yMyw3OC4wMy03OC4wNWMxOS4zOC0xOS4zOCw1Mi41LTUuNjUsNTIuNSwyMS43NVoiLz48cGF0aCBjbGFzcz0iYiIgZD0iTTUwNi45Nyw3MDYuMTRsLTI2LjEyLDI2LjEyYy0xNC40NCwxNC40NC0zNy44NSwxNC40NC01Mi4yOSwwbC0yNi4xMi0yNi4xMiwzOS4yMS0zOS4yYzcuMjEtNy4yMiwxOC45LTcuMjIsMjYuMTIsMGwzOS4yLDM5LjJaIi8+PHBhdGggY2xhc3M9ImIiIGQ9Ik0yOTYuNzEsNDU5LjM0aDIyLjIyYzkuMDMsMCwxNi4zNyw3LjM0LDE2LjM3LDE2LjM3djIzLjkxYzAsOC4xLTYuNTgsMTQuNjctMTQuNjcsMTQuNjdoLTIzLjkxYy05LjAzLDAtMTYuMzctNy4zNC0xNi4zNy0xNi4zN3YtMjIuMjJjMC05LjAzLDcuMzQtMTYuMzcsMTYuMzctMTYuMzdaIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSg0MzQuMzkgLTc1LjA4KSByb3RhdGUoNDUpIi8+PHBhdGggY2xhc3M9ImIiIGQ9Ik01OTAuNDgsNDU5LjM0aDIyLjIyYzkuMDMsMCwxNi4zNyw3LjM0LDE2LjM3LDE2LjM3djIzLjkxYzAsOC4xLTYuNTgsMTQuNjctMTQuNjcsMTQuNjdoLTIzLjkxYy05LjAzLDAtMTYuMzctNy4zNC0xNi4zNy0xNi4zN3YtMjIuMjJjMC05LjAzLDcuMzQtMTYuMzcsMTYuMzctMTYuMzdaIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSg1MjAuNDMgLTI4Mi44MSkgcm90YXRlKDQ1KSIvPjxwYXRoIGNsYXNzPSJiIiBkPSJNNzc2LjYzLDM0OC42MUw1MDYuMzIsNzguMzFjLTI4LjUtMjguNTItNzQuNzItMjguNTItMTAzLjIzLDBMMTMyLjc3LDM0OC42MWMtMjQuMjYsMjQuMjctMjQuMjYsNjMuNjEsMCw4Ny44OGwzNC43LDM0LjY4YzE0LjMsMTQuMywzNy41MSwxNC4zLDUxLjgxLDBsNTIuODgtNTIuODhjMTQuMzItMTQuMTQsMzcuNDEtMTQuMDgsNTEuNjYsLjE3bDUyLjcyLDUyLjcyYzE0LjI2LDE0LjI2LDE0LjMsMzcuMzcsLjE0LDUxLjY5LS4wNSwuMDUtLjA5LC4wOS0uMTQsLjE0bC0yNi4zNiwyNi4zNmMtMTQuNDMsMTQuNDQtMjEuNjQsMzMuMzUtMjEuNjQsNTIuMjZzNy4yMiwzNy44MiwyMS42NCw1Mi4yNmw0MS45Miw0MS45Miw0My45OC00My45NmMxMC4yOC0xMC4zMSwyNi45Ny0xMC4zMSwzNy4yOCwwbDQzLjk2LDQzLjk2LDQxLjkzLTQxLjkyYzE0LjQ0LTE0LjQ0LDIxLjY0LTMzLjM1LDIxLjY0LTUyLjI2cy03LjIxLTM3LjgyLTIxLjY0LTUyLjI2bC0yNi4zNi0yNi4zNmMtMTQuMzItMTQuMzItMTQuMzItMzcuNTIsMC01MS44Mmw1Mi43LTUyLjcyYy4wOS0uMDksLjE4LS4xOCwuMjctLjI2LDE0LjMzLTE0LjA1LDM3LjM0LTEzLjk2LDUxLjU1LC4yNmw1Mi43Miw1Mi43MmMxNC4zLDE0LjMsMzcuNTEsMTQuMyw1MS44MiwwbDM0LjY4LTM0LjY4YzI0LjI2LTI0LjI3LDI0LjI2LTYzLjYxLDAtODcuODhaIi8+PC9zdmc+',
            100
        );
	}

    /**
     * Admin dashboard callback. Get the main template for the admin dashboard
     * @return void
     */
    public static function adminDashboardCallback(): void
    {
        get_template_part('admin/templates/dashboard');
    }

}