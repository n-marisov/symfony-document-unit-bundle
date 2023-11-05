<?php

namespace Maris\Symfony\DocumentUnit\Form;

use Maris\Symfony\DocumentUnit\Entity\Bik;
use Maris\Symfony\DocumentUnit\Factory\BikFactory;
use ReflectionException;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;

/**
 * Поле для ввода БИК.
 */
class BikType extends AbstractType implements DataTransformerInterface
{

    protected BikFactory $factory;

    /**
     * @param BikFactory $factory
     */
    public function __construct(BikFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
        $builder->addViewTransformer( $this );
    }

    public function configureOptions(OptionsResolver $resolver):void
    {
        $resolver->setDefaults([
            "constraints" =>[
                new Length(min: 9,max: 9,
                    exactMessage: 'Длинна БИК должна составлять {{limit}} символов, передана "{{value}}" ({{value_length }} символов).'
                ),
                new Regex(
                    pattern: "/\d*/",
                    message: 'БИК может состоять только из цифр передана стока "{{value}}".'
                )
            ],
            "trim" => true
        ]);
    }

    /**
     * Тип поля.
     * @return string
     */
    public function getBlockPrefix():string
    {
        return "text";
    }

    /**
     * @param Bik|null $value
     * @return string
     */
    public function transform( mixed $value ):string
    {
        return is_null($value) ? "" : $value;
    }

    /**
     * @param mixed $value
     * @return Bik|null
     * @throws ReflectionException
     */
    public function reverseTransform( mixed $value ):?Bik
    {
        return is_string($value) ? $this->factory->create($value) : null;
    }
}