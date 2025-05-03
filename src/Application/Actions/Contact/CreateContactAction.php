<?php

declare(strict_types=1);

namespace App\Application\Actions\Contact;

use Psr\Http\Message\ResponseInterface as Response;

class CreateContactAction extends ContactAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $params = $this->request->getQueryParams();
        //   $contact = new Contact();
        //save  contact 
        //send email

        // $this->logger->info(sprintf("Email from %s to %s was sent ",$from, $to));

        return $this->respondWithMessage('The email was sent  ');
    }
}
