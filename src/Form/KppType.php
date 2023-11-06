<?php

namespace Maris\Symfony\DocumentUnit\Form;

use Maris\Symfony\DocumentUnit\Entity\Bik;
use Maris\Symfony\DocumentUnit\Factory\KppFactory;
use ReflectionException;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Поле для ввода КПП.
 */
class KppType extends AbstractType implements DataTransformerInterface
{

    protected KppFactory $factory;
    protected TranslatorInterface $translator;

    /**
     * @param KppFactory $factory
     * @param TranslatorInterface $translator
     */
    public function __construct(KppFactory $factory, TranslatorInterface $translator )
    {
        $this->factory = $factory;
        $this->translator = $translator;
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
            "invalid_message" => $this->translator->trans("document.unit.form.kpp.invalid_message"),
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
        if(!$this->factory->valid($value))
            throw new TransformationFailedException();

        return is_string($value) ? $this->factory->create($value) : null;
    }
}