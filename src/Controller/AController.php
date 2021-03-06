<?php
declare(strict_types=1);

namespace App\Controller;

use App\Core\Abstracts\ARepository;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AController
 *
 * @package App\Controller
 */
class AController extends AbstractFOSRestController
{
    /**
     * @param $data
     * @param array|string|null $groups
     * @param array $headers
     * @param int $statusCode
     *
     * @return Response
     */
    public function response($data, $groups = null, array $headers = [], int $statusCode = 200): Response
    {
        if (\is_string($groups)) {
            $groups = [$groups];
        }
        $view = $this->view($data, $statusCode, $headers);

        if($groups && \count($groups)){
            $context = new Context();
            $context->setGroups($groups);
            $view->setContext($context);
        }

        return $this->handleView($view);
    }

    /**
     * @param string $formClass
     * @param array $data
     * @param null $object
     *
     * @return Form
     */
    protected function validateRequestData(string $formClass, array $data, $object = null): Form
    {
        /** @var Form $form */
        $form = $this->createForm($formClass, $object);
        $form->submit($data);

        return $form;
    }

    /**
     * @param $data
     * @param ARepository $repository
     *
     * @return array
     * @throws \Exception
     */
    protected function getCollectionByFilters($data, ARepository $repository): array
    {
        $filters = $data['filters'];
        $order = $data['order'];
        $pagination = $data['pagination'];

        $pager = $repository->filterBy($filters, $order, $pagination);

        return [
            'items' => $pager->getItems(),
            'pagination' => [
                'page' => $pager->getCurrentPageNumber(),
                'totalPages' => 1 + (int)($pager->getTotalItemCount() / $pager->getItemNumberPerPage()),
                'totalItems' => $pager->getTotalItemCount(),
                'limit' => $pager->getItemNumberPerPage(),
                'count' => \count($pager->getItems()),
            ]
        ];
    }
}