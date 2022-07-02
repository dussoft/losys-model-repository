<?php

namespace Referenzverwaltung;

use Illuminate\Support\ServiceProvider;
use Referenzverwaltung\Repositories\AddressCompanyContactPersonRepository;
use Referenzverwaltung\Repositories\AddressRepository;
use Referenzverwaltung\Repositories\CantonRepository;
use Referenzverwaltung\Repositories\CategoryLanguageRepository;
use Referenzverwaltung\Repositories\CategoryRepository;
use Referenzverwaltung\Repositories\CompanyContactPersonRepository;
use Referenzverwaltung\Repositories\CompanyEmployeeRepository;
use Referenzverwaltung\Repositories\CompanyEmployeeLanguageRepository;
use Referenzverwaltung\Repositories\CompanyLanguageRepository;
use Referenzverwaltung\Repositories\CompanyRepository;
use Referenzverwaltung\Repositories\CompanyServiceRepository;
use Referenzverwaltung\Repositories\CountryRepository;
use Referenzverwaltung\Repositories\DefaultTypeOfBuildingLanguageRepository;
use Referenzverwaltung\Repositories\DefaultTypeOfBuildingRepository;
use Referenzverwaltung\Repositories\DefaultTypeOfConstructionLanguageRepository;
use Referenzverwaltung\Repositories\DefaultTypeOfConstructionRepository;
use Referenzverwaltung\Repositories\DefaultTypeOfWorkLanguageRepository;
use Referenzverwaltung\Repositories\DefaultTypeOfWorkRepository;
use Referenzverwaltung\Repositories\GroupCompanyRepository;
use Referenzverwaltung\Repositories\GroupMemberRepository;
use Referenzverwaltung\Repositories\GroupPrintPdfTemplateRepository;
use Referenzverwaltung\Repositories\GroupRepository;
use Referenzverwaltung\Repositories\GroupRightRepository;
use Referenzverwaltung\Repositories\GroupServiceRepository;
use Referenzverwaltung\Repositories\IframeTemplateRepository;
use Referenzverwaltung\Repositories\LanguageRepository;
use Referenzverwaltung\Repositories\MigrateOldDataRepository;
use Referenzverwaltung\Repositories\PrintPdfTemplateRepository;
use Referenzverwaltung\Repositories\ProjectAddressContactPersonRepository;
use Referenzverwaltung\Repositories\ProjectAttributeLanguageRepository;
use Referenzverwaltung\Repositories\ProjectAttributeRepository;
use Referenzverwaltung\Repositories\ProjectCategoryRepository;
use Referenzverwaltung\Repositories\ProjectImageRepository;
use Referenzverwaltung\Repositories\ProjectParticipatingCompanyInvolvedRepository;
use Referenzverwaltung\Repositories\ProjectParticipatingCompanyRepository;
use Referenzverwaltung\Repositories\ProjectPropertyRepository;
use Referenzverwaltung\Repositories\ProjectRepository;
use Referenzverwaltung\Repositories\ProjectTypeOfBuildingRepository;
use Referenzverwaltung\Repositories\ProjectTypeOfConstructionRepository;
use Referenzverwaltung\Repositories\ProjectTypeOfWorkRepository;
use Referenzverwaltung\Repositories\ProjectVideoRepository;
use Referenzverwaltung\Repositories\RequestRepository;
use Referenzverwaltung\Repositories\ServiceRepository;
use Referenzverwaltung\Repositories\TranslationRepository;
use Referenzverwaltung\Repositories\TypeOfBuildingLanguageRepository;
use Referenzverwaltung\Repositories\TypeOfBuildingRepository;
use Referenzverwaltung\Repositories\TypeOfConstructionLanguageRepository;
use Referenzverwaltung\Repositories\TypeOfConstructionRepository;
use Referenzverwaltung\Repositories\TypeOfWorkLanguageRepository;
use Referenzverwaltung\Repositories\TypeOfWorkRepository;
use Referenzverwaltung\Repositories\VisitorsRepository;



class LosysRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            AddressRepository::class
        );
    }
}
