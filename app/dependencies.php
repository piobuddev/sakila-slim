<?php declare(strict_types=1);

use DI\ContainerBuilder;
use Doctrine\ORM\EntityManagerInterface;
use League\Fractal\Manager;
use Psr\Log\LoggerInterface;
use Sakila\Application\Command\Bus\SimpleCommandBus;
use Sakila\Application\Logger\Monolog\LoggerFactory;
use Sakila\Command\Bus\CommandBusInterface;
use Sakila\Domain\Actor\Entity\Transformer\ActorTransformerInterface;
use Sakila\Domain\Actor\Repository\ActorRepositoryInterface;
use Sakila\Domain\Actor\Repository\Database\ActorRepository;
use Sakila\Domain\Actor\Validator\ActorValidatorInterface;
use Sakila\Domain\Address\Entity\Transformer\AddressTransformerInterface;
use Sakila\Domain\Address\Repository\AddressRepositoryInterface;
use Sakila\Domain\Address\Repository\Database\AddressRepository;
use Sakila\Domain\Address\Validator\AddressValidatorInterface;
use Sakila\Domain\Category\Entity\Transformer\CategoryTransformerInterface;
use Sakila\Domain\Category\Repository\CategoryRepositoryInterface;
use Sakila\Domain\Category\Repository\Database\CategoryRepository;
use Sakila\Domain\Category\Validator\CategoryValidatorInterface;
use Sakila\Domain\City\Entity\Transformer\CityTransformerInterface;
use Sakila\Domain\City\Repository\CityRepositoryInterface;
use Sakila\Domain\City\Repository\Database\CityRepository;
use Sakila\Domain\City\Validator\CityValidatorInterface;
use Sakila\Domain\Country\Entity\Transformer\CountryTransformerInterface;
use Sakila\Domain\Country\Repository\CountryRepositoryInterface;
use Sakila\Domain\Country\Repository\Database\CountryRepository;
use Sakila\Domain\Country\Validator\CountryValidatorInterface;
use Sakila\Domain\Customer\Entity\Transformer\CustomerTransformerInterface;
use Sakila\Domain\Customer\Repository\CustomerRepositoryInterface;
use Sakila\Domain\Customer\Repository\Database\CustomerRepository;
use Sakila\Domain\Customer\Validator\CustomerValidatorInterface;
use Sakila\Domain\Entity\FactoryAdapter;
use Sakila\Domain\Film\Entity\Transformer\FilmTransformerInterface;
use Sakila\Domain\Film\Repository\Database\FilmRepository;
use Sakila\Domain\Film\Repository\FilmRepositoryInterface;
use Sakila\Domain\Film\Validator\FilmValidatorInterface;
use Sakila\Domain\Inventory\Entity\Transformer\InventoryTransformerInterface;
use Sakila\Domain\Inventory\Repository\Database\InventoryRepository;
use Sakila\Domain\Inventory\Repository\InventoryRepositoryInterface;
use Sakila\Domain\Inventory\Validator\InventoryValidatorInterface;
use Sakila\Domain\Language\Entity\Transformer\LanguageTransformerInterface;
use Sakila\Domain\Language\Repository\Database\LanguageRepository;
use Sakila\Domain\Language\Repository\LanguageRepositoryInterface;
use Sakila\Domain\Language\Validator\LanguageValidatorInterface;
use Sakila\Domain\Payment\Entity\Transformer\PaymentTransformerInterface;
use Sakila\Domain\Payment\Repository\Database\PaymentRepository;
use Sakila\Domain\Payment\Repository\PaymentRepositoryInterface;
use Sakila\Domain\Payment\Validator\PaymentValidatorInterface;
use Sakila\Domain\Rental\Entity\Transformer\RentalTransformerInterface;
use Sakila\Domain\Rental\Repository\Database\RentalRepository;
use Sakila\Domain\Rental\Repository\RentalRepositoryInterface;
use Sakila\Domain\Rental\Validator\RentalValidatorInterface;
use Sakila\Domain\Staff\Entity\Transformer\StaffTransformerInterface;
use Sakila\Domain\Staff\Repository\Database\StaffRepository;
use Sakila\Domain\Staff\Repository\StaffRepositoryInterface;
use Sakila\Domain\Staff\Validator\StaffValidatorInterface;
use Sakila\Domain\Store\Entity\Transformer\StoreTransformerInterface;
use Sakila\Domain\Store\Repository\Database\StoreRepository;
use Sakila\Domain\Store\Repository\StoreRepositoryInterface;
use Sakila\Domain\Store\Validator\StoreValidatorInterface;
use Sakila\Domain\Transformers\ActorTransformer;
use Sakila\Domain\Transformers\AddressTransformer;
use Sakila\Domain\Transformers\CategoryTransformer;
use Sakila\Domain\Transformers\CityTransformer;
use Sakila\Domain\Transformers\CountryTransformer;
use Sakila\Domain\Transformers\CustomerTransformer;
use Sakila\Domain\Transformers\FilmTransformer;
use Sakila\Domain\Transformers\FractalTransformerAdapter;
use Sakila\Domain\Transformers\InventoryTransformer;
use Sakila\Domain\Transformers\LanguageTransformer;
use Sakila\Domain\Transformers\PaymentTransformer;
use Sakila\Domain\Transformers\RentalTransformer;
use Sakila\Domain\Transformers\StaffTransformer;
use Sakila\Domain\Transformers\StoreTransformer;
use Sakila\Domain\Validators\ActorValidator;
use Sakila\Domain\Validators\AddressValidator;
use Sakila\Domain\Validators\CategoryValidator;
use Sakila\Domain\Validators\CityValidator;
use Sakila\Domain\Validators\CountryValidator;
use Sakila\Domain\Validators\CustomerValidator;
use Sakila\Domain\Validators\FilmValidator;
use Sakila\Domain\Validators\InventoryValidator;
use Sakila\Domain\Validators\LanguageValidator;
use Sakila\Domain\Validators\PaymentValidator;
use Sakila\Domain\Validators\RentalValidator;
use Sakila\Domain\Validators\StaffValidator;
use Sakila\Domain\Validators\StoreValidator;
use Sakila\Entity\FactoryInterface;
use Sakila\Infrastructure\Persistence\Database\Doctrine\Connection;
use Sakila\Infrastructure\Persistence\Database\Doctrine\EntityManagerFactory;
use Sakila\Repository\Database\ConnectionInterface;
use Sakila\Repository\Database\Table\NameResolverInterface;
use Sakila\Repository\Database\Table\SimpleNameResolver;
use Sakila\Transformer\TransformerInterface;
use function DI\autowire;
use function DI\create;
use function DI\factory;
use function DI\get;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->useAutowiring(true)->addDefinitions(
        [
            LoggerInterface::class => factory([LoggerFactory::class, 'create'])->parameter('settings', get('settings')),
            ConnectionInterface::class => DI\autowire(Connection::class),
            EntityManagerInterface::class => factory([EntityManagerFactory::class, 'create'])
                ->parameter('connection', get('connection')),

            CommandBusInterface::class   => autowire(SimpleCommandBus::class),
            FactoryInterface::class      => create(FactoryAdapter::class),
            NameResolverInterface::class => create(SimpleNameResolver::class),
            Manager::class               => create(),
            TransformerInterface::class  => autowire(FractalTransformerAdapter::class),

            ActorValidatorInterface::class   => create(ActorValidator::class),
            ActorTransformerInterface::class => create(ActorTransformer::class),
            ActorRepositoryInterface::class  => autowire(ActorRepository::class),

            AddressValidatorInterface::class   => create(AddressValidator::class),
            AddressTransformerInterface::class => create(AddressTransformer::class),
            AddressRepositoryInterface::class  => autowire(AddressRepository::class),

            CategoryValidatorInterface::class   => create(CategoryValidator::class),
            CategoryTransformerInterface::class => create(CategoryTransformer::class),
            CategoryRepositoryInterface::class  => autowire(CategoryRepository::class),

            CityValidatorInterface::class   => create(CityValidator::class),
            CityTransformerInterface::class => create(CityTransformer::class),
            CityRepositoryInterface::class  => autowire(CityRepository::class),

            CountryValidatorInterface::class   => create(CountryValidator::class),
            CountryTransformerInterface::class => create(CountryTransformer::class),
            CountryRepositoryInterface::class  => autowire(CountryRepository::class),

            CustomerValidatorInterface::class   => create(CustomerValidator::class),
            CustomerTransformerInterface::class => create(CustomerTransformer::class),
            CustomerRepositoryInterface::class  => autowire(CustomerRepository::class),

            FilmValidatorInterface::class   => create(FilmValidator::class),
            FilmTransformerInterface::class => create(FilmTransformer::class),
            FilmRepositoryInterface::class  => autowire(FilmRepository::class),

            InventoryValidatorInterface::class   => create(InventoryValidator::class),
            InventoryTransformerInterface::class => create(InventoryTransformer::class),
            InventoryRepositoryInterface::class  => autowire(InventoryRepository::class),

            LanguageValidatorInterface::class   => create(LanguageValidator::class),
            LanguageTransformerInterface::class => create(LanguageTransformer::class),
            LanguageRepositoryInterface::class  => autowire(LanguageRepository::class),

            PaymentValidatorInterface::class   => create(PaymentValidator::class),
            PaymentTransformerInterface::class => create(PaymentTransformer::class),
            PaymentRepositoryInterface::class  => autowire(PaymentRepository::class),

            RentalValidatorInterface::class   => create(RentalValidator::class),
            RentalTransformerInterface::class => create(RentalTransformer::class),
            RentalRepositoryInterface::class  => autowire(RentalRepository::class),

            StaffValidatorInterface::class   => create(StaffValidator::class),
            StaffTransformerInterface::class => create(StaffTransformer::class),
            StaffRepositoryInterface::class  => autowire(StaffRepository::class),

            StoreValidatorInterface::class   => create(StoreValidator::class),
            StoreTransformerInterface::class => create(StoreTransformer::class),
            StoreRepositoryInterface::class  => autowire(StoreRepository::class),
        ]
    );
};
