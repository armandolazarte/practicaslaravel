<?php
namespace Siequipos\Services\Html;

class FormBuilder extends \Collective\Html\FormBuilder
{
	/**
	 * Create buttons.
	 *
	 * @return string
	 */
	public function bootbuttons($url)
	{
		return sprintf('
			<div class="form-group" align="center">
        <button type="submit" class="btn btn-primary btn-md fa fa-plus-circle">
          Guardar datos
        </button>
        <button type="reset" class="btn btn-success fa fa-refresh">
          Limpiar
        </button>
        <a href="%s" class="btn btn-danger glyphicon glyphicon-backward">
          Volver
        </a>
			</div>',
			$url
		);
	}
  
	public function bootcreate($url)
	{
		return sprintf('
      <a href="%s" class="btn btn-primary pull-right fa fa-plus-circle">
        Crear
      </a>',
			$url
		);
	}
  
	/**
	 * Create a wrapped text input.
	 *
	 * @return string
	 */
	public function boottext($name, $label, $errors, $input = null)
	{
		return sprintf('
			<div class="row">
				<div class="form-group %s">
					%s
					<div class="col-md-10">
						%s
						<small class="help-block">%s</small>
					</div>
				</div>
			</div>',
			$errors->has($name) ? 'has-error' : '',
			parent::label($name, $label, ["class" => "col-md-2"]),
			parent::text($name, $input, ['class' => 'form-control']),
			$errors->first($name)
		);
	}

	/**
	 * Create a wrapped select input.
	 *
	 * @return string
	 */
	public function bootselect($name, $label, $select, $id = null)
	{
		return sprintf('
			<div class="row">
				<div class="form-group">
					%s
					<div class="col-md-10">
						%s
					</div>
				</div>
			</div>',
			parent::label($name, $label, ["class" => "col-md-2"]),
			parent::select($name, $select, $id, ['class' => 'form-control'])
		);
	}

	/**
	 * Create a wrapped select input with button.
	 *
	 * @return string
	 */
	public function bootselectbutton($name, $num, $label, $select, $id = null)
	{
		$i = $name.$num;
		return sprintf('
			<div class="row line" id="%s">
				<div class="form-group">
					%s
					<div class="col-md-8">
						%s
					</div>
					<div class="col-md-2">
						<button type="button" class="btn btn-danger pull-right">Delete</button>
					</div>
				</div>
			</div>',
			'line'.$i,
			parent::label($i, $label, ["class" => "col-md-2"]),
			parent::select($i, $select, $id, ['class' => 'form-control', 'name' => $name.'[]']),
			$name
		);
	}

	/**
	 * Create a legend.
	 *
	 * @return string
	 */
	public function bootlegend($legend)
	{
		return sprintf('
			<div class="row">
				<legend>%s</legend>
			</div>',
			$legend
		);
	}
  
  public function control($type, $columns, $name, $errors, $label = null, $value = null, $pop = null, $placeholder = '')
	{
		$attributes = ['class' => 'form-control', 'placeholder' => $placeholder];
		return sprintf('
			<div class="form-group %s %s">
        <div class="row">
			  %s
			  %s
        <div class="col-xs-7">
				%s
				%s
			</div></div></div>',
			($columns == 0)? '': 'col-xs-' . $columns,
			$errors->has($name) ? 'has-error' : '',
			$label ? $this->label($name, $label, ['class' => 'control-label col-xs-2']) : '',
			$pop? '<a href="#" tabindex="0" class="badge pull-right" data-toggle="popover" data-trigger="focus" title="' . $pop[0] .'" data-content="' . $pop[1] . '"><span>?</span></a>' : '',
			call_user_func_array(['Form', $type], ($type == 'password')? [$name, $attributes] : [$name, $value, $attributes]),
			$errors->first($name, '<small class="help-block">:message</small>')
		);
	}
  
	public function submit($value = null, $options = [])
	{
		return sprintf('
			<div class="form-group %s">
				%s
			</div>',
			empty($options) ? '' : $options[0],
			parent::submit($value, ['class' => 'btn btn-primary btn-md'])
		);
	}
  
  
//	public function submit($value = null, $options = [])
//	{
//    $options['class'] = 'btn btn-primary btn-md' . (isset($options['class']) ? ' ' . $options['class'] : '');
//		return parent::submit($value, $options);
//	}
  
  public function button($value = null, $options = [])
  {
    if ( ! array_key_exists('type', $options))
    {
      $options['type'] = 'submit';
    }
//      return '<button'.$this->html->attributes($options).'>'.$value.'</button>';
    return parent::button($value, $options);
  }
  
  public function reset($value = null, $options = [])
  {
    if ( ! array_key_exists('type', $options))
    {
      $options['type'] = 'reset';
    }
//      return '<button'.$this->html->attributes($options).'>'.$value.'</button>';
    return parent::reset($value, $options);
  }
  
	public function destroy($text, $message, $class = null)
	{
		return parent::submit($text, ['class' => 'btn btn-danger btn-xs entity' . ($class? $class:''), 'onclick' => 'return confirm(\'' . $message . '\')']);
	}

	public function check($name, $label)
	{
		return sprintf('
			<div class="checkbox col-lg-12">
				<label>
			  	%s%s
			  </label>
			</div>',
			parent::checkbox($name),
			$label
		);		
	}

	public function selection($name, $list = [], $selected = null, $label = null)
	{
		return sprintf('
			<div class="form-group" style="width:200px;">
				%s
			  %s
			</div>',
			$label ? $this->label($name, $label, ['class' => 'control-label']) : '',
			parent::select($name, $list, $selected, ['class' => 'form-control'])
		);
	}
}