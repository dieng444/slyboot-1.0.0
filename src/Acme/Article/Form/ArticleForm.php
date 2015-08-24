<?php
namespace Minijournal\Article\Form;

use Slyboot\Main\Form\MainForm;
use Slyboot\Main\Entity\MainEntity;
use Minijournal\Article\Entity\Article;
use Slyboot\Util\Validator\MainValidator;
use Slyboot\Util\Validator\ValidatorInterface;

/**
 * Class ArticleForm : hérite de la class DocumentForm
 * @author Elhadj Macky Dieng
 * @copyright	M1DNR2I - 2015
 * @license Académique
 */
class ArticleForm extends MainForm implements ValidatorInterface
{

    /**
     * L'article à insérer ou à modifier
     * @var Minijournal\Article\Entity\Article :
     **/
    protected $article;
    /**
    * Constructeur de la classe
    * @param Article $article l'obejet article à enregistrer
    * ou modifier
    */
    public function __construct(Article $article=null)
    {
        parent::__construct();
        $this->article = $article;
    }
    /**
     * Renvoie l'article à afficher dans le formulaire
     * @method getObjectInstance
     * @return Minijournal\Article\Entity\Article
     */
    public function getFormEntity()
    {
        return $this->article;
    }
    /**
     * Appelle le gestionnaire d'utilitaire des
     * validateurs, pour ainsi effectuer la validation
     * d'un article donné.
     * @param array $validators : tabeleau de validateurs optionnel
     * @param array $article : article à valider
     */
    public static function validate($validators,MainEntity $entity)
    {
        $mainValidator = new MainValidator();
        $result = $mainValidator->addValidator($validators, $entity);
        return $result;
    }
    /**
     * Permet aux développeurs de spécifier les validateurs
     * à utiliser pour le formulaire courant
     */
    public function validatorsToUse()
    {
        $acceptValidators = array(
                                  "FieldLengthValidator",
                                  "SelectListValidator",
                                  "EmptyFieldValidator"
                                 );

        return $acceptValidators;
    }
    /**
     * Permet de préciser les directives de validations
     * des attirbuts de l'objet courant (article ici)
     * @return Minijournal\Article\Entity\Article
     */
    public function getValidationInfos()
    {
        $infos = array("auteur" => array("options" =>
                                           array(
                                                  "_blank" => false,
                                                  "_min_length" => 4,
                                                  "_empty_error_msg" => "Le champ <b>auteur</b> ne peut pas être vide",
                                                  "_length_error_msg" => "Le champ <b>auteur</b> ne pas faire moins de 4 caractères"
                                                )
                                        ),
                       "titre" => array("options" =>
                                         array(
                                                "_min_length" => 4,
                                                "_blank" => false,
                                                "_empty_error_msg" => "Le champ <b>titre</b> ne peut pas être vide",
                                                "_length_error_msg" => "Le champ <b>titre</b> ne pas faire moins de 4 caractères"
                                              )
                                       ),
                       "chapo" => array("options" =>
                                         array(
                                                "_blank" => true,
                                              )

                                       ),
                        "contenu" => array("options" =>
                                         array(
                                               "_blank" => false,
                                               "_min_length" => 20,
                                               "_empty_error_msg" => "Le champ <b>contenu</b> ne peut pas être vide",
                                               "_length_error_msg" => "Le champ <b>contenu</b> ne pas faire moins de 20 caractères"
                                              )
                                        ),
                        "statut" => array("options" =>
                                        array(
                                                "_blank" => false,
                                                "_empty_error_msg" => "Le champ <b>statut</b> ne peut pas être vide",
                                                "_accepted_values" => array("Public","Privé"),
                                                "_accepted_values_msg" => "Le champ <b>statut</b> ne peut contenir
                                                                          que <b>Privé</b> ou <b>Public</b>"
                                             )
                                        ),
                );

        return $infos;
    }
}
