<?php

declare(strict_types=1);

namespace App\Application\Actions\Contact;

use App\Domain\Contact\Contact;
use Fig\Http\Message\StatusCodeInterface;
use Slim\Exception\HttpBadRequestException;
use Psr\Http\Message\ResponseInterface as Response;
use App\Domain\DomainException\DomainRecordNotFoundException;

class CreateContactAction extends ContactAction
{


    /** 
     * @OA\Post ( 
     *  tags={"contact"}, 
     *  path="/contact", 
     *  operationId="createContact", 
     *  @OA\Response ( 
     *      response="201", 
     *      description="Create a contact and send an email", 
     *       @OA\JsonContent ( 
     *          type="string"
     *       ) 
     *   ) 
     * )  
     * @throws DomainRecordNotFoundException
     * @throws HttpBadRequestException
     * @return Response
     */
    protected function action(): Response
    {
        $params = $this->request->getQueryParams();

        $contact = new Contact(null, $params['name'], $params['email'], $params['comment']);
        $contact = $this->contactRepository->save($contact);
        $this->emailTransport->sendContactEmail($contact);
        $this->logger->info(sprintf("Email from %s  was sent ", $contact->getEmail()));

        return $this->respondWithMessage('The email was sent ', StatusCodeInterface::STATUS_CREATED);
    }
}
