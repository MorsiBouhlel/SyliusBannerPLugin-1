<?php
declare(strict_types=1);

namespace Black\SyliusBannerPlugin\UI\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;

final class SlideTranslationType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content', TextareaType::class, [
                'label' => 'black_sylius_banner.form.slide.content.label',
                'required' => false,
            ])
            ->add('link', UrlType::class, [
                'label' => 'black_sylius_banner.form.slide.url.label',
                'required' => false,
            ])
        ;
    }
}
