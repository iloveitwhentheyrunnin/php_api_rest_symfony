<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\TaskRepository;
use App\Entity\Task;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[Route('/api/tasks')]
class TaskUpdateController extends AbstractController
{
    #[Route('/{id}', name: 'app_task_update', methods:"PATCH")]
    public function patchTask(int $id, Request $request, SerializerInterface $serializer, ValidatorInterface $validator, ManagerRegistry $doctrine): JsonResponse
    {
        // Symfony 6, $doctrine est injectée dans la méthode, il n'y a plus de $this->getDoctrine()

        $task = $doctrine->getRepository(Task::class)->find($id);

        if(empty($task)){
            return new JsonResponse(['message'=> 'Task not found'], Response::HTTP_NOT_FOUND);
        }

        // Désérialisation du patch
        $updatedData = $serializer->deserialize(
            $request->getContent(),
            Task::class,
            'json',
            ['object_to_populate' => $task, 'groups' => ['patch']]
        );

        // Mise a jour
        $task->setIsDone($updatedData->getIsDone());

        // Validation de la tâche mise à jour
        $errors = $validator->validate($task);
        
        // Ecriture en BDD
        $entityManager = $doctrine->getManager();
        $entityManager->flush();

        return new JsonResponse(['message' => 'Tâche mise à jour avec succès'], 200);
    }
}
