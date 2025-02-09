<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesCondition;

use Ivoz\Api\Core\Annotation\AttributeDefinition;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar\ConditionalRoutesConditionsRelCalendarDto;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist\ConditionalRoutesConditionsRelMatchlistDto;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelRouteLock\ConditionalRoutesConditionsRelRouteLockDto;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule\ConditionalRoutesConditionsRelScheduleDto;

class ConditionalRoutesConditionDto extends ConditionalRoutesConditionDtoAbstract
{
    const CONTEXT_WITH_INVERSE_RELATIONSHIPS = 'withInverseRelationships';

    const CONTEXTS_WITH_INVERSE_RELATIONSHIPS = [
        self::CONTEXT_WITH_INVERSE_RELATIONSHIPS,
        self::CONTEXT_DETAILED
    ];

    /**
     * @var int[]
     * @AttributeDefinition(
     *     type="array",
     *     collectionValueType="int",
     *     description="Matchlist ids"
     * )
     */
    protected $matchListIds = [];

    /**
     * @var int[]
     * @AttributeDefinition(
     *     type="array",
     *     collectionValueType="int",
     *     description="Schedule ids"
     * )
     */
    protected $scheduleIds = [];

    /**
     * @var int[]
     * @AttributeDefinition(
     *     type="array",
     *     collectionValueType="int",
     *     description="Calendar ids"
     * )
     */
    protected $calendarIds = [];

    /**
     * @var int[]
     * @AttributeDefinition(
     *     type="array",
     *     collectionValueType="int",
     *     description="Route lock ids"
     * )
     */
    protected $routeLockIds = [];

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'priority' => 'priority',
                'routeType' => 'routeType',
                'locutionId' => 'locution',
                'numberCountryId' => 'numberCountry',
                'numberValue' => 'numberValue',
                'ivrId' => 'ivr',
                'userId' => 'user',
                'huntGroupId' => 'huntGroup',
                'voicemailUserId' => 'voicemailUser',
                'friendValue' => 'friendValue',
                'queueId' => 'queue',
                'conferenceRoomId' => 'conferenceRoom',
                'extensionId' => 'extension',
            ];
        }

        $response = parent::getPropertyMap(...func_get_args());

        if (in_array($context, self::CONTEXTS_WITH_INVERSE_RELATIONSHIPS, true)) {
            $response['matchListIds'] = 'matchListIds';
            $response['scheduleIds'] = 'scheduleIds';
            $response['calendarIds'] = 'calendarIds';
            $response['routeLockIds'] = 'routeLockIds';
        }

        return $response;
    }

    public function normalize(string $context, string $role = '')
    {
        $response = parent::normalize(
            $context,
            $role
        );

        if (in_array($context, self::CONTEXTS_WITH_INVERSE_RELATIONSHIPS, true)) {
            $response['matchListIds'] = $this->matchListIds;
            $response['scheduleIds'] = $this->scheduleIds;
            $response['calendarIds'] = $this->calendarIds;
            $response['routeLockIds'] = $this->routeLockIds;
        }

        return $response;
    }

    public function setMatchListIds(array $matchlistIds): self
    {
        $this->matchListIds = $matchlistIds;

        $relMatchlist = [];
        foreach ($matchlistIds as $id) {
            $dto = new ConditionalRoutesConditionsRelMatchlistDto();
            $dto->setMatchlistId($id);
            $relMatchlist[] = $dto;
        }

        $this->setRelMatchlists($relMatchlist);

        return $this;
    }

    public function setCalendarIds(array $calendarIds): self
    {
        $this->calendarIds = $calendarIds;

        $relCalendars = [];
        foreach ($calendarIds as $id) {
            $dto = new ConditionalRoutesConditionsRelCalendarDto();
            $dto->setCalendarId($id);
            $relCalendars[] = $dto;
        }

        $this->setRelCalendars($relCalendars);

        return $this;
    }


    public function setScheduleIds(array $scheduleIds): self
    {
        $this->scheduleIds = $scheduleIds;

        $relScheduless = [];
        foreach ($scheduleIds as $id) {
            $dto = new ConditionalRoutesConditionsRelScheduleDto();
            $dto->setScheduleId($id);
            $relScheduless[] = $dto;
        }

        $this->setRelSchedules($relScheduless);

        return $this;
    }

    public function setRouteLockIds(array $routeLockIds): self
    {
        $this->routeLockIds = $routeLockIds;

        $relRouteLocks = [];
        foreach ($routeLockIds as $id) {
            $dto = new ConditionalRoutesConditionsRelRouteLockDto();
            $dto->setRouteLockId($id);
            $relRouteLocks[] = $dto;
        }

        $this->setRelRouteLocks($relRouteLocks);

        return $this;
    }
}
