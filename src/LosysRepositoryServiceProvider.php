<?php

namespace Referenzverwaltung;

use Illuminate\Support\ServiceProvider;
use Referenzverwaltung\Interfaces\AddressCompanyContactPersonRepositoryInterface;
use Referenzverwaltung\Interfaces\AddressRepositoryInterface;
use Referenzverwaltung\Interfaces\CantonRepositoryInterface;
use Referenzverwaltung\Interfaces\CategoryLanguageRepositoryInterface;
use Referenzverwaltung\Interfaces\CategoryRepositoryInterface;
use Referenzverwaltung\Interfaces\CompanyContactPersonRepositoryInterface;
use Referenzverwaltung\Interfaces\CompanyEmployeeRepositoryInterface;
use Referenzverwaltung\Interfaces\CompanyRepositoryInterface;
use Referenzverwaltung\Interfaces\CompanyServiceRepositoryInterface;
use Referenzverwaltung\Interfaces\CountryRepositoryInterface;
use Referenzverwaltung\Interfaces\DefaultTypeOfBuildingRepositoryInterface;
use Referenzverwaltung\Interfaces\DefaultTypeOfConstructionRepositoryInterface;
use Referenzverwaltung\Interfaces\DefaultTypeOfWorkRepositoryInterface;
use Referenzverwaltung\Interfaces\GroupCompanyRepositoryInterface;
use Referenzverwaltung\Interfaces\GroupPrintPdfTemplateRepositoryInterface;
use Referenzverwaltung\Interfaces\GroupRepositoryInterface;
use Referenzverwaltung\Interfaces\GroupServiceRepositoryInterface;
use Referenzverwaltung\Interfaces\IframeTemplateRepositoryInterface;
use Referenzverwaltung\Interfaces\LanguageRepositoryInterface;
use Referenzverwaltung\Interfaces\MigrateOldDataRepositoryInterface;
use Referenzverwaltung\Interfaces\PrintPdfTemplateRepositoryInterface;
use Referenzverwaltung\Interfaces\ProjectAddressContactPersonRepositoryInterface;
use Referenzverwaltung\Interfaces\ProjectAttributeLanguageRepositoryInterface;
use Referenzverwaltung\Interfaces\ProjectAttributeRepositoryInterface;
use Referenzverwaltung\Interfaces\ProjectCategoryRepositoryInterface;
use Referenzverwaltung\Interfaces\ProjectImageRepositoryInterface;
use Referenzverwaltung\Interfaces\ProjectParticipatingCompanyInvolvedRepositoryInterface;
use Referenzverwaltung\Interfaces\ProjectParticipatingCompanyRepositoryInterface;
use Referenzverwaltung\Interfaces\ProjectPropertyRepositoryInterface;
use Referenzverwaltung\Interfaces\ProjectRepositoryInterface;
use Referenzverwaltung\Interfaces\ProjectTypeOfBuildingRepositoryInterface;
use Referenzverwaltung\Interfaces\ProjectTypeOfConstructionRepositoryInterface;
use Referenzverwaltung\Interfaces\ProjectTypeOfWorkRepositoryInterface;
use Referenzverwaltung\Interfaces\ProjectVideoRepositoryInterface;
use Referenzverwaltung\Interfaces\ServiceRepositoryInterface;
use Referenzverwaltung\Interfaces\TranslationRepositoryInterface;
use Referenzverwaltung\Interfaces\TypeOfBuildingLanguageRepositoryInterface;
use Referenzverwaltung\Interfaces\TypeOfBuildingRepositoryInterface;
use Referenzverwaltung\Interfaces\TypeOfConstructionLanguageRepositoryInterface;
use Referenzverwaltung\Interfaces\TypeOfConstructionRepositoryInterface;
use Referenzverwaltung\Interfaces\TypeOfWorkLanguageRepositoryInterface;
use Referenzverwaltung\Interfaces\TypeOfWorkRepositoryInterface;
use Referenzverwaltung\Interfaces\VisitorsRepositoryInterface;

use Referenzverwaltung\Modals\AddressCompanyContactPersonRepository;
use Referenzverwaltung\Modals\AddressRepository;
use Referenzverwaltung\Modals\CantonRepository;
use Referenzverwaltung\Modals\CategoryLanguageRepository;
use Referenzverwaltung\Modals\CategoryRepository;
use Referenzverwaltung\Modals\CompanyContactPersonRepository;
use Referenzverwaltung\Modals\CompanyEmployeeRepository;
use Referenzverwaltung\Modals\CompanyRepository;
use Referenzverwaltung\Modals\CompanyServiceRepository;
use Referenzverwaltung\Modals\CountryRepository;
use Referenzverwaltung\Modals\DefaultTypeOfBuildingRepository;
use Referenzverwaltung\Modals\DefaultTypeOfConstructionRepository;
use Referenzverwaltung\Modals\DefaultTypeOfWorkRepository;
use Referenzverwaltung\Modals\GroupCompanyRepository;
use Referenzverwaltung\Modals\GroupPrintPdfTemplateRepository;
use Referenzverwaltung\Modals\GroupRepository;
use Referenzverwaltung\Modals\GroupServiceRepository;
use Referenzverwaltung\Modals\IframeTemplateRepository;
use Referenzverwaltung\Modals\LanguageRepository;
use Referenzverwaltung\Modals\MigrateOldDataRepository;
use Referenzverwaltung\Modals\PrintPdfTemplateRepository;
use Referenzverwaltung\Modals\ProjectAddressContactPersonRepository;
use Referenzverwaltung\Modals\ProjectAttributeLanguageRepository;
use Referenzverwaltung\Modals\ProjectAttributeRepository;
use Referenzverwaltung\Modals\ProjectCategoryRepository;
use Referenzverwaltung\Modals\ProjectImageRepository;
use Referenzverwaltung\Modals\ProjectParticipatingCompanyInvolvedRepository;
use Referenzverwaltung\Modals\ProjectParticipatingCompanyRepository;
use Referenzverwaltung\Modals\ProjectPropertyRepository;
use Referenzverwaltung\Modals\ProjectRepository;
use Referenzverwaltung\Modals\ProjectTypeOfBuildingRepository;
use Referenzverwaltung\Modals\ProjectTypeOfConstructionRepository;
use Referenzverwaltung\Modals\ProjectTypeOfWorkRepository;
use Referenzverwaltung\Modals\ProjectVideoRepository;
use Referenzverwaltung\Modals\ServiceRepository;
use Referenzverwaltung\Modals\TranslationRepository;
use Referenzverwaltung\Modals\TypeOfBuildingLanguageRepository;
use Referenzverwaltung\Modals\TypeOfBuildingRepository;
use Referenzverwaltung\Modals\TypeOfConstructionLanguageRepository;
use Referenzverwaltung\Modals\TypeOfConstructionRepository;
use Referenzverwaltung\Modals\TypeOfWorkLanguageRepository;
use Referenzverwaltung\Modals\TypeOfWorkRepository;
use Referenzverwaltung\Modals\VisitorsRepository;



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
        $this->app->bind(AddressCompanyContactPersonRepositoryInterface::class, AddressCompanyContactPersonRepository::class);
        $this->app->bind(AddressRepositoryInterface::class, AddressRepository::class);
        $this->app->bind(CantonRepositoryInterface::class, CantonRepository::class);
        $this->app->bind(CategoryLanguageRepositoryInterface::class, CategoryLanguageRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(CompanyContactPersonRepositoryInterface::class, CompanyContactPersonRepository::class);
        $this->app->bind(CompanyEmployeeRepositoryInterface::class, CompanyEmployeeRepository::class);
        $this->app->bind(CompanyRepositoryInterface::class, CompanyRepository::class);
        $this->app->bind(CompanyServiceRepositoryInterface::class, CompanyServiceRepository::class);
        $this->app->bind(CountryRepositoryInterface::class, CountryRepository::class);
        $this->app->bind(DefaultTypeOfBuildingRepositoryInterface::class, DefaultTypeOfBuildingRepository::class);
        $this->app->bind(DefaultTypeOfConstructionRepositoryInterface::class, DefaultTypeOfConstructionRepository::class);
        $this->app->bind(DefaultTypeOfWorkRepositoryInterface::class, DefaultTypeOfWorkRepository::class);
        $this->app->bind(GroupCompanyRepositoryInterface::class, GroupCompanyRepository::class);
        $this->app->bind(GroupPrintPdfTemplateRepositoryInterface::class, GroupPrintPdfTemplateRepository::class);
        $this->app->bind(GroupRepositoryInterface::class, GroupRepository::class);
        $this->app->bind(GroupServiceRepositoryInterface::class, GroupServiceRepository::class);
        $this->app->bind(IframeTemplateRepositoryInterface::class, IframeTemplateRepository::class);
        $this->app->bind(LanguageRepositoryInterface::class, LanguageRepository::class);
        $this->app->bind(MigrateOldDataRepositoryInterface::class, MigrateOldDataRepository::class);
        $this->app->bind(PrintPdfTemplateRepositoryInterface::class, PrintPdfTemplateRepository::class);
        $this->app->bind(ProjectAddressContactPersonRepositoryInterface::class, ProjectAddressContactPersonRepository::class);
        $this->app->bind(ProjectAttributeLanguageRepositoryInterface::class, ProjectAttributeLanguageRepository::class);
        $this->app->bind(ProjectAttributeRepositoryInterface::class, ProjectAttributeRepository::class);
        $this->app->bind(ProjectCategoryRepositoryInterface::class, ProjectCategoryRepository::class);
        $this->app->bind(ProjectImageRepositoryInterface::class, ProjectImageRepository::class);
        $this->app->bind(ProjectParticipatingCompanyInvolvedRepositoryInterface::class, ProjectParticipatingCompanyInvolvedRepository::class);
        $this->app->bind(ProjectParticipatingCompanyRepositoryInterface::class, ProjectParticipatingCompanyRepository::class);
        $this->app->bind(ProjectPropertyRepositoryInterface::class, ProjectPropertyRepository::class);
        $this->app->bind(ProjectRepositoryInterface::class, ProjectRepository::class);
        $this->app->bind(ProjectTypeOfBuildingRepositoryInterface::class, ProjectTypeOfBuildingRepository::class);
        $this->app->bind(ProjectTypeOfConstructionRepositoryInterface::class, ProjectTypeOfConstructionRepository::class);
        $this->app->bind(ProjectTypeOfWorkRepositoryInterface::class, ProjectTypeOfWorkRepository::class);
        $this->app->bind(ProjectVideoRepositoryInterface::class, ProjectVideoRepository::class);
        $this->app->bind(ServiceRepositoryInterface::class, ServiceRepository::class);
        $this->app->bind(TranslationRepositoryInterface::class, TranslationRepository::class);
        $this->app->bind(TypeOfBuildingLanguageRepositoryInterface::class, TypeOfBuildingLanguageRepository::class);
        $this->app->bind(TypeOfBuildingRepositoryInterface::class, TypeOfBuildingRepository::class);
        $this->app->bind(TypeOfConstructionLanguageRepositoryInterface::class, TypeOfConstructionLanguageRepository::class);
        $this->app->bind(TypeOfConstructionRepositoryInterface::class, TypeOfConstructionRepository::class);
        $this->app->bind(TypeOfWorkLanguageRepositoryInterface::class, TypeOfWorkLanguageRepository::class);
        $this->app->bind(TypeOfWorkRepositoryInterface::class, TypeOfWorkRepository::class);
        $this->app->bind(VisitorsRepositoryInterface::class, VisitorsRepository::class);
    }
}
