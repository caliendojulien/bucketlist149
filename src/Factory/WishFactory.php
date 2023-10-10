<?php

namespace App\Factory;

use App\Entity\Wish;
use App\Repository\WishRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Wish>
 *
 * @method        Wish|Proxy create(array|callable $attributes = [])
 * @method static Wish|Proxy createOne(array $attributes = [])
 * @method static Wish|Proxy find(object|array|mixed $criteria)
 * @method static Wish|Proxy findOrCreate(array $attributes)
 * @method static Wish|Proxy first(string $sortedField = 'id')
 * @method static Wish|Proxy last(string $sortedField = 'id')
 * @method static Wish|Proxy random(array $attributes = [])
 * @method static Wish|Proxy randomOrCreate(array $attributes = [])
 * @method static WishRepository|RepositoryProxy repository()
 * @method static Wish[]|Proxy[] all()
 * @method static Wish[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Wish[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Wish[]|Proxy[] findBy(array $attributes)
 * @method static Wish[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Wish[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class WishFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'auteur' => self::faker()->firstName(255).' '.self::faker()->lastName(255),
            'dateCreated' => self::faker()->dateTime(),
            'description' => self::faker()->realText(),
            'isPublished' => self::faker()->boolean(),
            'title' => self::faker()->text(255),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Wish $wish): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Wish::class;
    }
}
