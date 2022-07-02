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
        $this->app->bind(AddressCompanyContactPersonRepository::class);
        $this->app->bind(AddressRepository::class);
        $this->app->bind(CantonRepository::class);
        $this->app->bind(CategoryLanguageRepository::class);
        $this->app->bind(CategoryRepository::class);
        $this->app->bind(CompanyContactPersonRepository::class);
        $this->app->bind(CompanyEmployeeRepository::class);
        $this->app->bind(CompanyEmployeeLanguageRepository::class);
        $this->app->bind(CompanyLanguageRepository::class);
        $this->app->bind(CompanyRepository::class);
        $this->app->bind(CompanyServiceRepository::class);
        $this->app->bind(CountryRepository::class);
        $this->app->bind(DefaultTypeOfBuildingLanguageRepository::class);
        $this->app->bind(DefaultTypeOfBuildingRepository::class);
        $this->app->bind(DefaultTypeOfConstructionLanguageRepository::class);
        $this->app->bind(DefaultTypeOfConstructionRepository::class);
        $this->app->bind(DefaultTypeOfWorkLanguageRepository::class);
        $this->app->bind(DefaultTypeOfWorkRepository::class);
        $this->app->bind(GroupCompanyRepository::class);
        $this->app->bind(GroupMemberRepository::class);
        $this->app->bind(GroupPrintPdfTemplateRepository::class);
        $this->app->bind(GroupRepository::class);
        $this->app->bind(GroupRightRepository::class);
        $this->app->bind(GroupServiceRepository::class);
        $this->app->bind(IframeTemplateRepository::class);
        $this->app->bind(LanguageRepository::class);
        $this->app->bind(MigrateOldDataRepository::class);
        $this->app->bind(PrintPdfTemplateRepository::class);
        $this->app->bind(ProjectAddressContactPersonRepository::class);
        $this->app->bind(ProjectAttributeLanguageRepository::class);
        $this->app->bind(ProjectAttributeRepository::class);
        $this->app->bind(ProjectCategoryRepository::class);
        $this->app->bind(ProjectImageRepository::class);
        $this->app->bind(ProjectParticipatingCompanyInvolvedRepository::class);
        $this->app->bind(ProjectParticipatingCompanyRepository::class);
        $this->app->bind(ProjectPropertyRepository::class);
        $this->app->bind(ProjectRepository::class);
        $this->app->bind(ProjectTypeOfBuildingRepository::class);
        $this->app->bind(ProjectTypeOfConstructionRepository::class);
        $this->app->bind(ProjectTypeOfWorkRepository::class);
        $this->app->bind(ProjectVideoRepository::class);
        $this->app->bind(ServiceRepository::class);
        $this->app->bind(RequestRepository::class);
        $this->app->bind(TranslationRepository::class);
        $this->app->bind(TypeOfBuildingLanguageRepository::class);
        $this->app->bind(TypeOfBuildingRepository::class);
        $this->app->bind(TypeOfConstructionLanguageRepository::class);
        $this->app->bind(TypeOfConstructionRepository::class);
        $this->app->bind(TypeOfWorkLanguageRepository::class);
        $this->app->bind(TypeOfWorkRepository::class);
        $this->app->bind(VisitorsRepository::class);
    }
}
