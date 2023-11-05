<?php

namespace Maris\Symfony\DocumentUnit\Form;

use Maris\Symfony\DocumentUnit\Entity\Bik;
use Maris\Symfony\DocumentUnit\Factory\BikFactory;
use ReflectionException;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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

    public function getParent():string
    {
        return TextType::class;
    }

    public function configureOptions(OptionsResolver $resolver):void
    {
        $resolver->setDefaults([
            "invalid_message" => "БИК может состоять только из цифр и должен иметь длину 9 символов.",
            "trim" => true
        ]);
    }

    /**
     * @param Bik|null $value
     * @return string
     */
    public function transform( mixed $value ):string
    {
        return is_null($value) ? "" : (string) $value;
    }

    /**
     * @param string|null $value
     * @return Bik|null
     * @throws ReflectionException
     */
    public function reverseTransform( mixed $value ):?Bik
    {

        /*if(is_string($value) && strlen($value) !== 9)
            throw new TransformationFailedException("Не соответствует длинна.");*/

        //dump($value);
        if(preg_match("~\D~",$value))
            throw new TransformationFailedException("Есть не числовые значения.");

        return is_string($value) ? $this->factory->create($value) : null;
    }
}