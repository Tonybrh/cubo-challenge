export const TaskStatusEnum = {
    PENDING: 1,
    IN_PROGRESS: 2,
    COMPLETED: 3,

    getLabel: (task_status_id) => {
        switch (Number(task_status_id)) {
            case TaskStatusEnum.PENDING:
                return 'Pendente';
            case TaskStatusEnum.IN_PROGRESS:
                return 'Em andamento';
            case TaskStatusEnum.COMPLETED:
                return 'Concluída';
            default:
                return 'Desconhecido';
        }
    },

    getColor: (task_status_id) => {
        switch (Number(task_status_id)) {
            case TaskStatusEnum.PENDING:
                return '#ff9800';
            case TaskStatusEnum.IN_PROGRESS:
                return '#2196f3';
            case TaskStatusEnum.COMPLETED:
                return '#4caf50';
            default:
                return '#9e9e9e';
        }
    }
};
