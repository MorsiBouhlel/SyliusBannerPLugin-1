<?php
declare(strict_types=1);

namespace Black\SyliusBannerPlugin\Repository;

use Black\SyliusBannerPlugin\Entity\Banner;
use Black\SyliusBannerPlugin\Entity\BannerInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Doctrine\ORM\Query\Parameter;
use Doctrine\Persistence\ObjectManager;
use Sylius\Component\Channel\Model\ChannelInterface;
use Doctrine\Persistence\ManagerRegistry;
use Webmozart\Assert\Assert;

final class BannerRepository implements BannerRepositoryInterface
{
    private ObjectManager $manager;

    private string $class;

    public function __construct(ManagerRegistry $registry, string $class)
    {
        $manager = $registry->getManagerForClass($class);
        Assert::notNull($manager);

        $this->manager = $manager;
        $this->class = $class;

    }

    /**
     * @psalm-suppress MixedReturnStatement
     * @psalm-suppress MixedInferredReturnType
     */
    public function findBannerForChannel(string $banner, ChannelInterface $channel): ?BannerInterface
    {
        /**
         * @var Query $query
         * @psalm-suppress UndefinedInterfaceMethod
         * @phpstan-ignore-next-line
         */
        $query = $this->manager->createQuery(<<<DQL
            SELECT banner
            FROM {$this->class} banner
            LEFT JOIN banner.channels channel
            WHERE banner.code = :code AND channel.id = :channel
        DQL
        );

        $query->setParameters(new ArrayCollection([
            new Parameter('code', $banner),
            new Parameter('channel', $channel->getId())
        ]));

        return $query->getOneOrNullResult();
    }
}
