<?php
class View
{
  private static $_viewPath;

  private static $_defaultLayout = 'layout.php';

  public static function setViewPath($path) {
    self::$_viewPath = $path;
  }

  public static function renderPartial($file, $data = array()) {
    # Extract data into local variables
    if (is_array($data)) {
      extract($data);
    }
    # Start output buffer
    ob_start();
    # Render template
    include self::$_viewPath . '/' . $file;
    # Get result
    $result = ob_get_contents();
    # Clean buffer
    ob_end_clean();
    return $result;
  }

  public static function render($file, $data = array(), $layout = null) {
    # Render default layout
    if (!$layout) {
      $layout = self::$_defaultLayout;
    }
    # Render partial
    $content = self::renderPartial($file, $data);
    # Set content to layout
    $data['layout'] = array('content' => $content);
    # Render layout
    return self::renderPartial($layout, $data);
  }
}