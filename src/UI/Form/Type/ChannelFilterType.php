<?php
declare(strict_types=1);

namespace Black\SyliusBannerPlugin\UI\Form\Type;

use Sylius\Component\Channel\Repository\ChannelRepositoryInterface;
use Sylius\Component\Core\Model\ChannelInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Webmozart\Assert\Assert;

class ChannelFilterType extends AbstractType
{
    private ChannelRepositoryInterface $channelRepository;

    public function __construct(ChannelRepositoryInterface $channelRepository)
    {
        $this->channelRepository = $channelRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('channel', ChoiceType::class, [
            'choices' => $this->getChannelsList(),
            'label' => false,
            'placeholder' => 'sylius.ui.all',
        ]);
    }

    private function getChannelsList(): array
    {
        $channels = [];

        /** @var ChannelInterface $channel */
        foreach ($this->channelRepository->findBy(['enabled' => true]) as $channel) {
            Assert::notNull($channel->getName());
            Assert::notNull($channel->getCode());

            /** @psalm-suppress PossiblyNullArrayOffset */
            $channels[$channel->getName()] = $channel->getCode();
        }

        return $channels;
    }
}
