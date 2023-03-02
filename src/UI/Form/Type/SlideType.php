<?php
declare(strict_types=1);

namespace Black\SyliusBannerPlugin\UI\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Sylius\Bundle\ResourceBundle\Form\Type\ResourceTranslationsType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;

final class SlideType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('file', FileType::class, [
                'label' => 'sylius.form.image.file',
            ])
            ->add('translations', ResourceTranslationsType::class, [
                'entry_type' => SlideTranslationType::class,
                'label' => 'black_sylius_banner.form.slide.translations.label',
            ])
        ;
    }
}
